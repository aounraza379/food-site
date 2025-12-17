<?php
require_once "auth.php";
require_once "../config/db.php";

// Get order ID from GET or POST
$order_id = $_GET['id'] ?? $_GET['order_id'] ?? null;

if (!$order_id) {
    echo "<h3 class='text-red-600 text-center mt-10'>Invalid Order Request!</h3>";
    exit;
}

$order_id = intval($order_id);

// Fetch order
$order_res = $conn->query("SELECT * FROM orders WHERE id = $order_id");
if (!$order_res || $order_res->num_rows == 0) {
    echo "<h3 class='text-red-600 text-center mt-10'>Order Not Found!</h3>";
    exit;
}
$order = $order_res->fetch_assoc();

// Fetch items
$items = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
?>

<?php include "partials/header.php"; ?>
<?php include "partials/sidebar.php"; ?>

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8 mt-20 mb-10">

    <h2 class="text-2xl font-bold mb-4 text-center text-green-600">Order #<?= $order_id ?></h2>

    <?php if (isset($_GET['updated'])): ?>
    <div class="bg-green-200 text-green-800 p-3 rounded-lg mb-4 text-center">
        Order status updated successfully!
    </div>
    <?php endif; ?>

    <p><strong>Name:</strong> <?= htmlspecialchars($order['user_name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($order['user_email']) ?></p>
    <p>
        <strong>Status:</strong>
        <?php
            $status_colors = [
                'pending' => 'bg-yellow-500',
                'processing' => 'bg-blue-500',
                'on-the-way' => 'bg-indigo-500',
                'delivered' => 'bg-green-600',
                'cancelled' => 'bg-red-600'
            ];
            $status_text = ucfirst($order['status'] ?? 'pending');
            $status_class = $status_colors[$order['status']] ?? 'bg-gray-500';
        ?>
        <span class="px-3 py-1 rounded-full text-white"><?= $status_text ?></span>
        <p><strong>Phone:</strong> <?= htmlspecialchars($order['user_phone']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($order['user_address']) ?></p>
        <p><strong>City:</strong> <?= htmlspecialchars($order['user_city']) ?></p>

        <?php if (!empty($order['user_notes'])): ?>
        <p><strong>Notes:</strong> <?= htmlspecialchars($order['user_notes']) ?></p>
        <?php endif; ?>
        
    </p>

    <h3 class="text-xl font-semibold mt-6 mb-3">Items</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-xl">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Food Item</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Qty</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $items->fetch_assoc()): ?>
                <tr class="border-t">
                    <td class="py-3 px-4"><?= htmlspecialchars($item['food_name']) ?></td>
                    <td class="py-3 px-4"><?= $item['quantity'] ?></td>
                    <td class="py-3 px-4">$<?= number_format($item['price'], 2) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Status Update Form -->
    <div class="mt-6">
        <form action="update-status.php" method="POST" class="flex flex-col md:flex-row md:items-center gap-4">
            <input type="hidden" name="order_id" value="<?= $order_id ?>">

            <select name="status" class="border border-gray-300 px-4 py-2 rounded-lg">
                <option value="pending" <?= ($order['status'] ?? 'pending')=='pending'?'selected':''; ?>>Pending</option>
                <option value="processing" <?= ($order['status'] ?? '')=='processing'?'selected':''; ?>>Processing</option>
                <option value="on-the-way" <?= ($order['status'] ?? '')=='on-the-way'?'selected':''; ?>>On the way</option>
                <option value="delivered" <?= ($order['status'] ?? '')=='delivered'?'selected':''; ?>>Delivered</option>
                <option value="cancelled" <?= ($order['status'] ?? '')=='cancelled'?'selected':''; ?>>Cancelled</option>
            </select>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Update Status
            </button>
        </form>
    </div>

    <div class="mt-6">
        <a href="orders.php" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg">
            ⬅ Back to All Orders
        </a>
    </div>

</div>

<?php include "partials/footer.php"; ?>