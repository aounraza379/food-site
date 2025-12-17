<?php
require_once "auth.php";
require_once "../config/db.php";

$uid = $_SESSION['user']['id'];

$orders = $conn->query("SELECT COUNT(*) c FROM orders WHERE user_id=$uid")->fetch_assoc()['c'];
$spent = $conn->query("SELECT SUM(total_price) s FROM orders WHERE user_id=$uid")->fetch_assoc()['s'] ?? 0;
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="max-w-6xl mx-auto px-6 py-28">
<h1 class="text-3xl font-bold mb-6">My Dashboard</h1>

<div class="grid md:grid-cols-3 gap-6 mb-10">
  <div class="bg-white p-6 rounded shadow">
    <h3>Total Orders</h3>
    <p class="text-3xl font-bold"><?= $orders ?></p>
  </div>

  <div class="bg-white p-6 rounded shadow">
    <h3>Total Spent</h3>
    <p class="text-3xl font-bold">$<?= number_format($spent,2) ?></p>
  </div>

  <div class="bg-white p-6 rounded shadow">
    <h3>Account</h3>
    <a href="profile.php" class="text-amber-600">Manage Profile</a>
  </div>
</div>

<h2 class="text-xl font-bold mb-4">Recent Orders</h2>

<table class="w-full bg-white shadow rounded">
<tr class="bg-gray-100">
<th class="p-3">Order</th><th>Total</th><th>Status</th><th></th>
</tr>

<?php
$r = $conn->query("SELECT * FROM orders WHERE user_id=$uid ORDER BY created_at DESC LIMIT 5");
while ($o = $r->fetch_assoc()):
?>
<tr class="border-t">
<td class="p-3">#<?= $o['id'] ?></td>
<td>$<?= $o['total_price'] ?></td>
<td><?= $o['status'] ?></td>
<td>
<a href="order-details.php?id=<?= $o['id'] ?>" class="text-blue-600">View</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</div>

<?php include "../includes/footer.php"; ?>