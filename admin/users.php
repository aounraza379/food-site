<?php
require_once "auth.php";
require_once "../config/db.php";

if (isset($_GET['delete'])) {
$id = (int)$_GET['delete'];
$conn->query("DELETE FROM users WHERE id=$id AND role!='admin'");
header("Location: users.php"); exit;
}

$users = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>


<div class="max-w-6xl mx-auto px-6 py-28">
    <div>
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 max-w-6xl mx-auto my-6" role="alert">
            <p class="font-bold">Caution:</p>
            <p>Deleting a user is irreversible. Please ensure you have backed up any necessary data before proceeding with deletion.</p>
        </div>
    </div>
    <div class="max-w-6xl">
        <h1 class="text-2xl font-bold mb-6">Users</h1>

        <table class="w-full bg-white shadow rounded">
            <tr class="bg-gray-100">
                <th class="p-3">ID</th><th>Email</th><th>Role</th><th>Verified</th><th></th>
            </tr>

            <?php while ($u = $users->fetch_assoc()): ?>
            <tr class="border-t">
                <td class="p-3"><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= $u['role'] ?></td>
                <td><?= $u['email_verified'] ? 'Yes' : 'No' ?></td>
                <td>
                <?php if ($u['role'] !== 'admin'): ?>
                <a href="?delete=<?= $u['id'] ?>" class="text-red-600"
                onclick="return confirm('Delete user?')">Delete</a>
                <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<?php include "../includes/footer.php"; ?>