<?php
require_once "auth.php";
require_once "../config/db.php";

$msg = "";

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $new = $_POST['password'];
    $hash = password_hash($new, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
    $stmt->bind_param("si",$hash,$_SESSION['user']['id']);
    $stmt->execute();

    $msg = "Password updated.";
}
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="max-w-md mx-auto px-6 py-28">
<h1 class="text-2xl font-bold mb-6">Change Password</h1>

<?php if ($msg): ?><p class="text-green-600 mb-4"><?= $msg ?></p><?php endif; ?>

<form method="POST" class="bg-white p-6 shadow rounded space-y-4">
<input type="password" name="password" required class="w-full border p-3 rounded" placeholder="New password">
<button class="bg-amber-500 text-white px-6 py-2 rounded">Save</button>
</form>
</div>

<?php include "../includes/footer.php"; ?>