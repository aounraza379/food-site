<?php
require_once "auth.php";
require_once "../config/db.php";
$orders = $conn->query("SELECT * FROM orders ORDER BY id DESC");
include "partials/header.php";
include "partials/sidebar.php";
?>

<main class="pt-10 px-6 md:px-12">
    <h1 class="text-3xl font-bold mb-6">Orders</h1>
    <table class="w-full bg-white shadow rounded">
        <tr class="border-b font-semibold">
            <td class="p-3">ID</td><td>User</td><td>Total</td><td>Status</td><td>Action</td>
        </tr>
        <?php while($o=$orders->fetch_assoc()): ?>
        <tr class="border-b">
            <td class="p-3"><?= $o['id'] ?></td>
            <td><?= htmlspecialchars($o['user_name']) ?></td>
            <td>$<?= $o['total_price'] ?></td>
            <td><?= $o['status'] ?></td>
            <td><a class="text-blue-600" href="order-details.php?id=<?= $o['id'] ?>">View</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</main>
<?php include "partials/footer.php"; ?>