<?php
require_once "auth.php";
require_once "../config/db.php";

/*
|--------------------------------------------------------------------------
| HANDLE ADD FOOD (PROCESSING FIRST)
|--------------------------------------------------------------------------
*/
if (isset($_POST['add'])) {

    $name = trim($_POST['name']);
    $price = (float)$_POST['price'];
    $description = trim($_POST['description']);
    $is_special = (int)$_POST['is_special'];

    // Validate image
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
        die("Image upload failed");
    }

    // Image upload
    $imageName = time() . '_' . basename($_FILES['image']['name']);
    $uploadPath = "../assets/images/" . $imageName;

    move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

    // Insert into database
    $stmt = $conn->prepare(
        "INSERT INTO food_items (name, description, price, image, is_special)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssdsi",
        $name,
        $description,
        $price,
        $imageName,
        $is_special
    );

    $stmt->execute();

    // Redirect to prevent duplicate submission
    header("Location: food-items.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| HANDLE DELETE
|--------------------------------------------------------------------------
*/
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM food_items WHERE id = $id");
}

/*
|--------------------------------------------------------------------------
| FETCH FOODS
|--------------------------------------------------------------------------
*/
$foods = $conn->query("SELECT * FROM food_items ORDER BY id DESC");
?>

<?php include "partials/header.php"; ?>
<?php include "partials/sidebar.php"; ?>

<div class="pt-10 px-6 md:px-12">
    <h1 class="text-3xl font-bold mb-6">Food Menu</h1>

    <!-- ADD FOOD FORM -->
    <form method="POST" enctype="multipart/form-data"
          class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        <input name="name" required
               placeholder="Food Name"
               class="border p-2 rounded">

        <input name="price" type="number" step="0.01" required
               placeholder="Price"
               class="border p-2 rounded">

        <textarea name="description" required
                  placeholder="Food Description"
                  class="border p-2 rounded md:col-span-2"></textarea>

        <input type="file" name="image" accept="image/*" required
               class="border p-2 rounded">

        <select name="is_special" class="border p-2 rounded">
            <option value="0">Normal Item</option>
            <option value="1">Special Item</option>
        </select>

        <button name="add"
                class="bg-amber-500 text-white px-4 py-2 rounded md:col-span-2">
            Add Food Item
        </button>
    </form>

    <!-- FOOD LIST -->
    <table class="w-full bg-white shadow rounded">
        <tr class="bg-gray-100">
            <th class="p-3">Name</th>
            <th>Price</th>
            <th>Type</th>
            <th>Action</th>
        </tr>

        <?php while ($f = $foods->fetch_assoc()): ?>
        <tr class="border-t">
            <td class="p-3"><?= htmlspecialchars($f['name']) ?></td>
            <td>$<?= number_format($f['price'], 2) ?></td>
            <td><?= $f['is_special'] ? 'Special' : 'Normal' ?></td>
            <td>
                <a href="?delete=<?= $f['id'] ?>"
                   class="text-red-600"
                   onclick="return confirm('Delete item?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include "partials/footer.php"; ?>