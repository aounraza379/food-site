<?php
session_start();
require __DIR__ . '/../config/db.php';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';

// Ensure cart items structure is correct
$cart_items = [];
$total_price = 0;
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $sql = "SELECT * FROM food_items WHERE id IN ($ids)";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $row['quantity'] = $_SESSION['cart'][$id]['quantity'];
        $row['subtotal'] = $row['quantity'] * $row['price'];
        $total_price += $row['subtotal'];
        $cart_items[$id] = $row;
    }
}
?>

<div class="max-w-6xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-semibold mb-6 mt-5">Your Cart</h1>

    <?php if (empty($cart_items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="w-full table-auto bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 text-left">Food</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Quantity</th>
                    <th class="p-3">Subtotal</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td class="p-3"><?= htmlspecialchars($item['name']) ?></td>
                    <td class="p-3">$<?= number_format($item['price'], 2) ?></td>
                    <td class="p-3">
                        <form method="post" action="../process/update-cart.php" class="flex gap-2">
                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="w-20 p-1 border rounded">
                            <input type="hidden" name="food_id" value="<?= $item['id'] ?>">
                            <button type="submit" name="action" value="update" class="bg-blue-500 text-white px-3 py-1 rounded">Update</button>
                        </form>
                    </td>
                    <td class="p-3">$<?= number_format($item['subtotal'], 2) ?></td>
                    <td class="p-3">
                        <form method="post" action="../process/update-cart.php">
                            <input type="hidden" name="food_id" value="<?= $item['id'] ?>">
                            <button type="submit" name="action" value="remove" class="bg-red-500 text-white px-3 py-1 rounded">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <p class="text-xl font-semibold">Total: $<?= number_format($total_price, 2) ?></p>

            <!-- Place order form -->
            <form action="../process/place-order.php" method="post" class="mt-4">
                <input type="text" name="user_name" placeholder="Your Name" required class="p-2 border rounded mr-2">
                <input type="email" name="user_email" placeholder="Your Email" required class="p-2 border rounded mr-2">
                <button type="submit" class="bg-amber-500 text-white px-6 py-2 rounded hover:bg-amber-600">Place Order</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>