<?php
require_once "auth.php";
require_once "../config/db.php";

$id = (int)$_GET['id'];
$uid = $_SESSION['user']['id'];

$o = $conn->query("SELECT * FROM orders WHERE id=$id AND user_id=$uid")->fetch_assoc();
if (!$o) die("Order not found");
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>

<div class="max-w-4xl mx-auto px-6 py-28">
<h1 class="text-2xl font-bold mb-4">Order #<?= $o['id'] ?></h1>
<p>Status: <strong><?= $o['status'] ?></strong></p>
<p>Total: <strong>$<?= $o['total_price'] ?></strong></p>
</div>

<?php include "../includes/footer.php"; ?>