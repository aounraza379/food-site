<?php
session_start();
require_once "../config/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = "All fields are required.";
    } else {

        // username OR email allowed
        $stmt = $conn->prepare("
            SELECT * 
            FROM users 
            WHERE (username = ? OR email = ?) 
              AND role = 'admin'
            LIMIT 1
        ");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();

            if (password_verify($password, $admin['password'])) {

                // unified session (same as user login)
                $_SESSION['user'] = [
                    'id'       => $admin['id'],
                    'username' => $admin['username'],
                    'email'    => $admin['email'],
                    'role'     => $admin['role']
                ];

                header("Location: /admin/index.php");
                exit;

            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "Admin account not found.";
        }
    }
}
?>

<!-- Header -->
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="flex items-center justify-center h-screen">
  <div class="flex flex-col max-w-md p-8 rounded-xl shadow-xl bg-white">
    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Admin Login</h2>

    <?php if ($error): ?>
        <p class="text-red-600 text-center mb-4"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <input
            type="text"
            name="username"
            placeholder="Username or Email"
            required
            class="w-full border p-3 rounded focus:ring-2 focus:ring-amber-500"
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
            class="w-full border p-3 rounded focus:ring-2 focus:ring-amber-500"
        >

        <button class="w-full bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-lg font-semibold">
            Login
        </button>
    </form>
</div>

</body>
</html>