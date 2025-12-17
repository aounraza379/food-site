<?php
require_once "auth.php";
require_once "../config/db.php";

if (isset($_POST['add'])) {
$stmt = $conn->prepare("INSERT INTO food_items(name,price) VALUES (?,?)");
$stmt->bind_param("sd", $_POST['name'], $_POST['price']);
$stmt->execute();
}

if (isset($_GET['delete'])) {
$conn->query("DELETE FROM food_items WHERE id=".(int)$_GET['delete']);
}

$foods = $conn->query("SELECT * FROM food_items");
?>

<?php include "partials/header.php"; ?>
<?php include "partials/sidebar.php"; ?>

<div class="pt-10 px-6 md:px-12">
    <h1 class="text-3xl font-bold mb-6">Food Menu</h1>

    <form method="POST" class="flex gap-4 mb-6">
        <input name="name" required placeholder="Food Name" class="border p-2">
        <input name="price" required placeholder="Price" class="border p-2">
        <button name="add" class="bg-amber-500 text-white px-4">Add</button>
    </form>

    <table class="w-full bg-white shadow rounded">
        <tr class="bg-gray-100">
            <th class="p-3">Name</th><th>Price</th><th></th>
        </tr>

        <?php while ($f = $foods->fetch_assoc()): ?>
        <tr class="border-t">
            <td class="p-3"><?= htmlspecialchars($f['name']) ?></td>
            <td>$<?= $f['price'] ?></td>
            <td>
                <a href="?delete=<?= $f['id'] ?>" class="text-red-600"
                onclick="return confirm('Delete item?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include "partials/footer.php"; ?>