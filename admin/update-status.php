<?php
session_start();

// Only allow logged-in admins
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

require __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = intval($_POST['order_id']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
    $stmt->close();

    header("Location: order-details.php?order_id=" . $order_id . "&updated=1");
    exit();
}