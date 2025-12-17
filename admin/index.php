<?php
session_start();
require_once "../config/db.php";

// Check admin login
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch metrics
// Total Users
$userStmt = $conn->prepare("SELECT COUNT(*) as total_users FROM users");
$userStmt->execute();
$userCount = $userStmt->get_result()->fetch_assoc()['total_users'];

// Total Orders
$orderStmt = $conn->prepare("SELECT COUNT(*) as total_orders FROM orders");
$orderStmt->execute();
$orderCount = $orderStmt->get_result()->fetch_assoc()['total_orders'];

// Total Food Items
$foodStmt = $conn->prepare("SELECT COUNT(*) as total_food FROM food_items");
$foodStmt->execute();
$foodCount = $foodStmt->get_result()->fetch_assoc()['total_food'];
?>

<!-- Header -->
<?php include '../includes/header.php'; ?>

<!-- Navbar -->
<?php include '../includes/navbar.php'; ?>

<div class="pt-20 px-6 md:px-12">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-gray-500 text-sm font-semibold">Total Users</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2"><?= $userCount ?></p>
            </div>
            <a href="/admin/users.php" class="text-amber-500 mt-4 hover:underline">Manage Users</a>
        </div>

        <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-gray-500 text-sm font-semibold">Total Orders</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2"><?= $orderCount ?></p>
            </div>
            <a href="/admin/orders.php" class="text-amber-500 mt-4 hover:underline">View Orders</a>
        </div>

        <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-gray-500 text-sm font-semibold">Food Items</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2"><?= $foodCount ?></p>
            </div>
            <a href="/admin/food-items.php" class="text-amber-500 mt-4 hover:underline">Manage Menu</a>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Recent Orders</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 border-b text-left text-sm font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $recentOrders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");
                    while ($order = $recentOrders->fetch_assoc()):
                    ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b"><?= $order['id'] ?></td>
                        <td class="px-6 py-4 border-b"><?= htmlspecialchars($order['user_name']) ?></td>
                        <td class="px-6 py-4 border-b"><?= htmlspecialchars($order['user_email']) ?></td>
                        <td class="px-6 py-4 border-b">$<?= number_format($order['total_price'],2) ?></td>
                        <td class="px-6 py-4 border-b capitalize"><?= htmlspecialchars($order['status']) ?></td>
                        <td class="px-6 py-4 border-b">
                            <a href="/admin/order-details.php?id=<?= $order['id'] ?>" class="text-amber-500 hover:underline">View</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>