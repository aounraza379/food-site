<?php
session_start();
require __DIR__ . '/../config/db.php';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';

$token = trim($_GET['token'] ?? '');
$error = false;
$message = '';

if ($token === '') {
    $error = true;
    $message = "Invalid verification token.";
} else {
    // Attempt to verify user in a single query
    $stmt = $conn->prepare("UPDATE users 
                            SET email_verified = 1, verification_token = NULL 
                            WHERE verification_token = ? AND email_verified = 0");
    $stmt->bind_param("s", $token);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        $message = "Email verified successfully! You can now login.";
    } else {
        // Check if token exists but already verified
        $stmt_check = $conn->prepare("SELECT id, email_verified FROM users WHERE verification_token = ?");
        $stmt_check->bind_param("s", $token);
        $stmt_check->execute();
        $res = $stmt_check->get_result();

        if ($res && $res->num_rows === 1) {
            $user = $res->fetch_assoc();
            if ($user['email_verified']) {
                $message = "Your email is already verified. You can login.";
            } else {
                $error = true;
                $message = "Unable to verify at this moment.";
            }
        } else {
            $error = true;
            $message = "Invalid or expired token.";
        }
        $stmt_check->close();
    }

    $stmt->close();
}
?>

<div class="min-h-screen flex items-center justify-center px-4 py-12">
  <div class="w-full max-w-xl bg-white shadow-lg rounded-2xl p-10">
    <h2 class="text-2xl font-semibold mb-4">Email Verification</h2>
    <div class="<?= $error ? 'bg-red-50 border border-red-200 text-red-800' : 'bg-green-50 border border-green-200 text-green-800' ?> p-4 rounded mb-4">
        <?= htmlspecialchars($message) ?>
    </div>
    <p class="mt-4"><a class="text-blue-600" href="login.php">Go to Login</a></p>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>