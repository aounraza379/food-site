<?php
require_once "auth.php";
require_once "../config/db.php";

$id = (int)$_GET['id'];
$uid = $_SESSION['user']['id'];

// Get order info
$o = $conn->query("SELECT * FROM orders WHERE id=$id AND user_id=$uid")->fetch_assoc();
if (!$o) die("Order not found");

// Get order items
$items = $conn->query("
    SELECT oi.*, f.name 
    FROM order_items oi
    JOIN food_items f ON f.id = oi.food_id
    WHERE oi.order_id = $id
");
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="max-w-4xl mx-auto px-6 py-28">
    <h1 class="text-2xl font-bold mb-4">Order #<?= $o['id'] ?></h1>
    <p><strong>Status:</strong> <?= ucfirst($o['status']) ?></p>
    <p><strong>Placed on:</strong> <?= date('F j, Y, g:i A', strtotime($o['created_at'])) ?></p>

    <h2 class="text-xl font-semibold mt-6 mb-2">Items</h2>
    <table class="w-full bg-white shadow rounded mb-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Food</th>
                <th class="p-3 text-right">Price</th>
                <th class="p-3 text-center">Qty</th>
                <th class="p-3 text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php while($item = $items->fetch_assoc()): ?>
            <tr class="border-t">
                <td class="p-3"><?= htmlspecialchars($item['name']) ?></td>
                <td class="p-3 text-right">$<?= number_format($item['price'],2) ?></td>
                <td class="p-3 text-center"><?= $item['quantity'] ?></td>
                <td class="p-3 text-right">$<?= number_format($item['price'] * $item['quantity'],2) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <p class="text-right font-bold text-lg">Total: $<?= number_format($o['total_price'],2) ?></p>
</div>

<?php include "../includes/footer.php"; ?>