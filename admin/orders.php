<?php
require_once "auth.php";
require_once "../config/db.php";

$orders = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="max-w-6xl mx-auto px-4 py-20">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">All Orders</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-xl">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">ID</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Email</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Total Price</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Status</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $orders->fetch_assoc()): ?>
                <?php
                    $status = $row['status'] ?? 'pending';
                    $colors = [
                        'pending' => 'bg-yellow-500',
                        'processing' => 'bg-blue-500',
                        'on-the-way' => 'bg-indigo-500',
                        'delivered' => 'bg-green-600',
                        'cancelled' => 'bg-red-600'
                    ];
                ?>
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-3 px-4"><?= $row['id'] ?></td>
                    <td class="py-3 px-4"><?= htmlspecialchars($row['user_name']) ?></td>
                    <td class="py-3 px-4"><?= htmlspecialchars($row['user_email']) ?></td>
                    <td class="py-3 px-4">$<?= number_format($row['total_price'], 2) ?></td>
                    <td class="py-3 px-4">
                        <span class="text-white px-3 py-1 rounded-full text-sm <?= $colors[$status] ?? 'bg-gray-500' ?>">
                            <?= ucfirst($status) ?>
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <a href="order-details.php?id=<?= $row['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            View
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>