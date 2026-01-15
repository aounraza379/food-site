<?php
session_start();
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/constant.php';
require __DIR__ . '/../config/mail.php';

$prefill_email = '';

// Check remember cookie
if (!isset($_SESSION['user']) && !empty($_COOKIE['foodsite_remember'])) {
    $cookie = $_COOKIE['foodsite_remember'];
    $token_hash = hash('sha256', $cookie);

    $stmt = $conn->prepare("SELECT id, username, email, role FROM users WHERE remember_token = ? AND remember_expires > NOW()");
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $u = $res->fetch_assoc();
        if ($u['role'] !== 'admin') {
            $_SESSION['user'] = [
                'id' => $u['id'],
                'username' => $u['username'] ?: $u['email'],
                'email' => $u['email'],
                'role' => $u['role']
            ];
            
            // Load user's cart from database
            loadUserCartToSession($u['id'], $conn);
        }
    } else {
        setcookie('foodsite_remember', '', time() - 3600, '/');
    }
    $stmt->close();
}

// Checks if already logged In
if (isset($_SESSION['user'])) {
    header("Location: /index.php");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Enter a valid email.";
    if ($password === '') $errors[] = "Enter your password.";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id, username, password, role, email_verified FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows === 1) {
            $user = $res->fetch_assoc();

            if (!$user['email_verified']) {
                $errors[] = "Email not verified.";
            } elseif (password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'] ?: $email,
                    'email' => $email,
                    'role' => $user['role']
                ];

                // ========== CART MIGRATION START ==========
                // Migrate guest cart items to user's database cart
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $food_id => $item) {
                        // Check if item already exists in user's cart
                        $checkStmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND food_id = ?");
                        $checkStmt->bind_param("ii", $user['id'], $food_id);
                        $checkStmt->execute();
                        $checkResult = $checkStmt->get_result();
                        
                        if ($checkResult->num_rows > 0) {
                            // Item exists, update quantity
                            $existing = $checkResult->fetch_assoc();
                            $newQuantity = $existing['quantity'] + $item['quantity'];
                            
                            $updateStmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND food_id = ?");
                            $updateStmt->bind_param("iii", $newQuantity, $user['id'], $food_id);
                            $updateStmt->execute();
                            $updateStmt->close();
                        } else {
                            // Item doesn't exist, insert new
                            $insertStmt = $conn->prepare("INSERT INTO cart (user_id, food_id, quantity) VALUES (?, ?, ?)");
                            $insertStmt->bind_param("iii", $user['id'], $food_id, $item['quantity']);
                            $insertStmt->execute();
                            $insertStmt->close();
                        }
                        $checkStmt->close();
                    }
                }
                
                // Always load user's cart from database (whether there was guest cart or not)
                loadUserCartToSession($user['id'], $conn);
                // ========== CART MIGRATION END ==========

                if ($remember && $user['role'] !== 'admin') {
                    $raw_token = bin2hex(random_bytes(32));
                    $token_hash = hash('sha256', $raw_token);
                    $expires = (new DateTime('+30 days'))->format('Y-m-d H:i:s');

                    $stmt2 = $conn->prepare("UPDATE users SET remember_token = ?, remember_expires = ? WHERE id = ?");
                    $stmt2->bind_param("ssi", $token_hash, $expires, $user['id']);
                    $stmt2->execute();
                    $stmt2->close();

                    setcookie('foodsite_remember', $raw_token, time() + 60*60*24*30, '/', '', false, true);
                }

                if ($user['role'] === 'admin') {
                    $errors[] = "Admins must login from the admin panel.";
                    unset($_SESSION['user']);
                } else {
                    if (isset($_SESSION['redirect_after_login'])) {
                      $redirect = $_SESSION['redirect_after_login'];
                      unset($_SESSION['redirect_after_login']);
                      header("Location: $redirect");
                  } else {
                      header("Location: /index.php");
                  }
                  exit;
                }
            } else {
                $errors[] = "Invalid email or password.";
            }
        } else {
            $errors[] = "Invalid email or password.";
        }
        $stmt->close();
    }
}

// Pre-fill
$prefill_email = $_POST['email'] ?? ($prefill_email ?? '');

// Function to load user's cart from database to session
function loadUserCartToSession($user_id, $conn) {
    $loadStmt = $conn->prepare("SELECT c.food_id, c.quantity, fi.name, fi.price FROM cart c JOIN food_items fi ON c.food_id = fi.id WHERE c.user_id = ?");
    $loadStmt->bind_param("i", $user_id);
    $loadStmt->execute();
    $loadResult = $loadStmt->get_result();
    
    // Initialize cart array
    $_SESSION['cart'] = [];
    
    while ($row = $loadResult->fetch_assoc()) {
        $_SESSION['cart'][$row['food_id']] = [
            'name' => $row['name'],
            'price' => $row['price'],
            'quantity' => $row['quantity']
        ];
    }
    $loadStmt->close();
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="min-h-screen flex items-center justify-center px-4 py-16">
  <div class="w-full max-w-2xl bg-white shadow-xl rounded-2xl p-12">
    <h2 class="text-4xl font-bold text-gray-800 mb-3 animate-fadeIn">Welcome Back</h2>
    <p class="text-gray-600 text-sm mb-6">Login to continue managing your orders</p>

    <?php if ($errors): ?>
      <div class="bg-red-100 border border-red-200 text-red-700 p-4 rounded mb-5">
        <ul class="list-disc pl-5">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="" class="grid gap-5">
      <input type="email" name="email" placeholder="Email address" required value="<?= htmlspecialchars($prefill_email) ?>" class="p-4 text-lg border rounded-lg focus:ring-2 focus:ring-amber-400 outline-none">
      <input type="password" name="password" placeholder="Password" required class="p-4 text-lg border rounded-lg focus:ring-2 focus:ring-amber-400 outline-none">
      <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="remember" class="h-4 w-4">
        Remember me (30 days)
      </label>
      <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-lg text-lg font-semibold">Login</button>
    </form>

    <div class="mt-6 flex flex-col md:flex-row md:justify-between md:items-center">
      <p class="mt-5 text-sm text-gray-600">
        Don't have an account?
        <a class="text-blue-600" href="/pages/register.php">Register here</a>.
      </p>
      
      <p class="mt-5 text-sm text-gray-600">
        <a href="forgot-password.php" class="text-blue-600">
          Forgot Password?
        </a>
      </p>
    </div>

  </div>
</div>

<!-- Script -->
<script src="../assets/js/main.js"></script>

<!-- Style -->
<link rel="stylesheet" href="../assets/css/custom.css">

<!-- Footer -->
<?php include __DIR__ . '/../includes/footer.php'; ?>