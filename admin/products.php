<?php
require_once "auth.php";
require_once "../config/db.php";
$items = $conn->query("SELECT * FROM food_items");
include "partials/header.php";
include "partials/sidebar.php";
include '../includes/header.php';
?>
<main class="flex-1 p-8">
<h1 class="text-2xl font-bold mb-4">Products</h1>
<a href="add-product.php" class="bg-amber-500 text-white px-4 py-2 rounded">Add Product</a>
<table class="w-full mt-4 bg-white shadow rounded">
<tr class="border-b font-semibold">
<td class="p-3">Name</td><td>Price</td><td>Action</td>
</tr>
<?php while($f=$items->fetch_assoc()): ?>
<tr class="border-b">
<td class="p-3"><?= htmlspecialchars($f['name']) ?></td>
<td>$<?= $f['price'] ?></td>
<td>
<a class="text-blue-600" href="edit-product.php?id=<?= $f['id'] ?>">Edit</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</main>
<?php include "partials/footer.php"; ?>