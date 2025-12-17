    <?php
    session_start();

    if (!isset($_GET['order_id'])) {
        echo "Invalid order request.";
        exit;
    }

    require __DIR__ . '/../config/db.php';
    $order_id = intval($_GET['order_id']);

    // Fetch order details
    $order = $conn->query("SELECT * FROM orders WHERE id = $order_id")->fetch_assoc();

    // Fetch items
    $order_items = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
    ?>

    <?php include '../includes/header.php'; ?>
    <?php include '../includes/navbar.php'; ?>

    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="bg-white w-full max-w-2xl shadow-lg rounded-2xl p-8">

            <h2 class="text-3xl font-bold text-center text-green-600 mb-2">
                Order Placed Successfully!
            </h2>

            <p class="text-center text-gray-600">
                Thank you, 
                <span class="font-semibold text-gray-800">
                    <?= htmlspecialchars($order['user_name']) ?>
                </span>!
            </p>

            <p class="text-center text-gray-600 mb-6">
                Your order ID is 
                <span class="font-semibold text-gray-900">#<?= $order_id ?></span>.
            </p>

            <!-- ORDER SUMMARY -->
            <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">
                🛒 Order Summary
            </h3>

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
                        <?php while ($item = $order_items->fetch_assoc()): ?>
                        <tr class="border-t">
                            <td class="py-3 px-4 text-gray-800"><?= htmlspecialchars($item['food_name']) ?></td>
                            <td class="py-3 px-4 text-gray-800"><?= $item['quantity'] ?></td>
                            <td class="py-3 px-4 text-gray-800">$<?= number_format($item['price'], 2) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <h3 class="text-xl font-semibold text-gray-800 mt-6 text-center">
                Total: 
                <span class="text-green-600">$<?= number_format($order['total_price'], 2) ?></span>
            </h3>


            <!-- CUSTOMER INFORMATION -->
            <h3 class="text-xl font-semibold text-gray-800 mt-8 text-center">
                Customer Information
            </h3>

            <p class="text-center text-gray-700 mt-2">
                <strong>Phone:</strong> <?= htmlspecialchars($order['user_phone']) ?>
            </p>

            <p class="text-center text-gray-700">
                <strong>Address:</strong> <?= htmlspecialchars($order['user_address']) ?>
            </p>

            <p class="text-center text-gray-700">
                <strong>City:</strong> <?= htmlspecialchars($order['user_city']) ?>
            </p>

            <?php if (!empty($order['user_notes'])): ?>
            <p class="text-center text-gray-700">
                <strong>Note:</strong> <?= htmlspecialchars($order['user_notes']) ?>
            </p>
            <?php endif; ?>


            <div class="flex justify-center mt-8">
                <a href="/pages/menu.php" 
                class="bg-orange-500 hover:bg-orange-600 text-white py-3 px-6 rounded-xl font-semibold transition">
                    ⬅ Go Back to Menu
                </a>
            </div>

        </div>
    </div>

    <?php include '../includes/footer.php'; ?>