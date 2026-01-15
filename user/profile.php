<?php
require_once "auth.php";
require_once "../config/db.php";

$u = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['username']);
    $stmt = $conn->prepare("UPDATE users SET username=? WHERE id=?");
    $stmt->bind_param("si",$name,$u['id']);
    $stmt->execute();

    $_SESSION['user']['username'] = $name;
    header("Location: profile.php?updated=1");
    exit;
}
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="max-w-xl mx-auto px-6 py-28">
<h1 class="text-2xl font-bold mb-6">My Profile</h1>

<form method="POST" class="bg-white p-6 shadow rounded space-y-4">
<input name="username" value="<?= htmlspecialchars($u['username'] ?? '') ?>" class="w-full border p-3 rounded">
<input disabled value="<?= htmlspecialchars($u['email']) ?>" class="w-full border p-3 rounded bg-gray-100">
<button class="bg-amber-500 text-white px-6 py-2 rounded">Update</button>
</form>

<a href="change-password.php" class="block mt-6 text-red-600">Change Password</a>
</div>

<!-- Script -->
<script src="../assets/js/main.js"></script>

<!-- Footer -->
<?php include "../includes/footer.php"; ?>