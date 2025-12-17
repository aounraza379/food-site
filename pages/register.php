<?php
session_start();
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/constant.php';
require __DIR__ . '/../config/mail.php';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($username === '') $errors[] = "Username is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if ($password !== $password2) $errors[] = "Passwords do not match.";

    if (empty($errors)) {
        // check existing
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "An account with this email already exists.";
            $stmt->close();
        } else {
            $stmt->close();
            $pw_hash = password_hash($password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(24));
            $role = 'user';
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, verification_token) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $email, $pw_hash, $role, $token);
            $ok = $stmt->execute();
            $stmt->close();

            if ($ok) {
                // Build verify link
                $verify_link = BASE_URL . "/pages/verify.php?token=" . urlencode($token);

                // Email content
                $subject = "Verify your Foodie's Paradise account";
                $html = "<p>Hello " . htmlspecialchars($username) . ",</p>
                         <p>Thanks for registering. Click the link below to verify your email:</p>
                         <p><a href=\"" . $verify_link . "\">Verify my email</a></p>
                         <p>If that doesn't work copy this URL into your browser:</p>
                         <p>" . htmlspecialchars($verify_link) . "</p>
                         <p>Cheers,<br>Foodie's Paradise</p>";
                $mail_result = send_email($email, $username, $subject, $html);

                if ($mail_result) {
                    $success = "Registration successful! Please check your email to verify your account.";
                } else {
                    // Show the dev link for local testing if email fails
                    $success = "Registration successful, but the verification email could not be sent. You can click the link below to verify:";
                    $dev_link = $verify_link;
                    error_log("MAIL FAILED for $email");
                }
            } else {
                $errors[] = "Database error — please try again.";
            }
        }
    }
}
?>

<div class="min-h-screen flex items-start justify-center px-4 py-28">
  <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-3">Create your account</h2>
    <p class="text-gray-600 mb-6">Sign up to save orders and manage your profile.</p>

    <?php if (!empty($errors)): ?>
      <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
          <ul class="list-disc pl-5"><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="bg-green-100 text-green-800 p-3 rounded mb-4"><?= htmlspecialchars($success) ?></div>
      <?php if (!empty($dev_link)): ?>
        <div class="bg-yellow-50 border border-yellow-200 p-3 rounded text-sm">
          <strong>Dev verification link:</strong><br>
          <a class="text-blue-600 break-words" href="<?= htmlspecialchars($dev_link) ?>"><?= htmlspecialchars($dev_link) ?></a>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <form method="post" action="" class="grid gap-4">
      <input type="text" name="username" placeholder="Username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" class="p-4 text-lg border rounded-lg">
      <input type="email" name="email" placeholder="Email address" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" class="p-4 text-lg border rounded-lg">
      <div class="grid md:grid-cols-2 gap-4">
        <input type="password" name="password" placeholder="Password (min 6 chars)" required class="p-4 text-lg border rounded-lg">
        <input type="password" name="password2" placeholder="Confirm password" required class="p-4 text-lg border rounded-lg">
      </div>
      <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-lg text-lg font-semibold">Create account</button>
    </form>

    <p class="mt-4 text-sm text-gray-600">Already have an account? <a class="text-blue-600" href="/pages/login.php">Login here</a>.</p>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>