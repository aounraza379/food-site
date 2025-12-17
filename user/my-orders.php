<?php
require_once "auth.php";
require_once "../config/db.php";

$uid = $_SESSION['user']['id'];
$orders = $conn->query("SELECT * FROM orders WHERE user_id=$uid ORDER BY created_at DESC");
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="min-h-screen flex items-start justify-center px-4 py-28">
    <div class="w-full max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 text-center md:text-left">
            My Orders
        </h1>

        <!-- Responsive wrapper -->
        <div class="overflow-x-auto">
            <table class="w-full bg-white shadow rounded-lg text-sm md:text-base">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3">ID</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($o = $orders->fetch_assoc()): ?>
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 font-medium">#<?= $o['id'] ?></td>
                        <td class="p-3">$<?= $o['total_price'] ?></td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-700">
                                <?= $o['status'] ?>
                            </span>
                        </td>
                        <td class="p-3 text-right">
                            <a
                                href="order-details.php?id=<?= $o['id'] ?>"
                                class="text-blue-600 hover:underline font-medium"
                            >
                                Details
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>