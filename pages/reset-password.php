<?php
require_once "../config/db.php";

$token = $_GET['token'] ?? '';

if (!$token) {
    die("Invalid reset link.");
}

$now = date("Y-m-d H:i:s");

$stmt = $conn->prepare("
    SELECT id 
    FROM users 
    WHERE reset_token = ?
      AND reset_expires > ?
");
$stmt->bind_param("ss", $token, $now);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Reset link is invalid or expired.");
}
?>

<?php include '../includes/header.php'; ?>

<div class="max-w-md mx-auto mt-20 bg-white shadow-lg rounded-xl p-8">
    <h2 class="text-2xl font-bold mb-6">Reset Password</h2>

    <form action="../process/reset-password-process.php" method="POST" class="space-y-4">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <input type="password" name="password" required minlength="6"
            class="w-full border p-3 rounded"
            placeholder="New Password">

        <button class="bg-amber-500 text-white w-full py-3 rounded-lg font-semibold">
            Update Password
        </button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>