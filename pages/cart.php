<?php
session_start();
require __DIR__ . '/../config/db.php';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/navbar.php';

$cart_items = [];
$total_price = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $result = $conn->query("SELECT * FROM food_items WHERE id IN ($ids)");

    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $row['quantity'] = $_SESSION['cart'][$id]['quantity'];
        $row['subtotal'] = $row['quantity'] * $row['price'];
        $total_price += $row['subtotal'];
        $cart_items[$id] = $row;
    }
}
?>

<div class="max-w-6xl mx-auto px-6 py-28 md:py-12">
    <h1 class="text-3xl font-semibold mb-6 mt-5">Your Cart</h1>

<?php if (empty($cart_items)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>

<div class="space-y-4">

    <?php foreach ($cart_items as $item): ?>
        <div class="bg-white shadow rounded-lg p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <!-- Food Name -->
            <div class="md:w-1/4">
                <p class="font-semibold text-lg">
                    <?= htmlspecialchars($item['name']) ?>
                </p>
            </div>

            <!-- Price -->
            <div class="flex justify-between md:block md:text-center md:w-1/6">
                <span class="text-gray-500 md:hidden">Price</span>
                <span>$<?= number_format($item['price'], 2) ?></span>
            </div>

            <!-- Quantity -->
            <div class="md:w-1/4">
                <form method="post" action="../process/update-cart.php" class="flex gap-2 items-center">
                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1"
                        class="w-20 p-1 border rounded">
                    <input type="hidden" name="food_id" value="<?= $item['id'] ?>">
                    <button type="submit" name="action" value="update"
                        class="bg-blue-500 text-white px-3 py-1 rounded">
                        Update
                    </button>
                </form>
            </div>

            <!-- Subtotal -->
            <div class="flex justify-between md:block md:text-center md:w-1/6">
                <span class="text-gray-500 md:hidden">Subtotal</span>
                <span class="font-semibold">$<?= number_format($item['subtotal'], 2) ?></span>
            </div>

            <!-- Remove -->
            <div class="md:w-1/6">
                <form method="post" action="../process/update-cart.php">
                    <input type="hidden" name="food_id" value="<?= $item['id'] ?>">
                    <button type="submit" name="action" value="remove"
                        class="w-full bg-red-500 text-white px-3 py-2 rounded">
                        Remove
                    </button>
                </form>
            </div>

        </div>
    <?php endforeach; ?>

</div>

<!-- Total & Checkout -->
<div class="mt-8 flex flex-col md:flex-row md:justify-end md:items-center gap-4">
    <p class="text-xl font-semibold">
        Total: $<?= number_format($total_price, 2) ?>
    </p>

    <a href="/pages/checkout.php"
       class="text-center bg-amber-500 text-white px-6 py-3 rounded hover:bg-amber-600">
        Proceed to Checkout
    </a>
</div>

<?php endif; ?>

</div>

<!-- Footer -->
<?php include __DIR__ . '/../includes/footer.php'; ?>

<!-- Style -->
<link rel="stylesheet" href="../assets/css/custom.css">

<!-- Script -->
<script src="../assets/js/main.js"></script>