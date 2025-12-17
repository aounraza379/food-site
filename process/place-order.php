<?php
session_start();
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/mail.php';

// ----------------------
// 1. SECURITY CHECKS
// ----------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /pages/cart.php");
    exit();
}

if (!isset($_SESSION['user'])) {
    header("Location: /pages/login.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    die("Your cart is empty.");
}

// ----------------------
// 2. USER & FORM DATA
// ----------------------
$user_id      = $_SESSION['user']['id'];
$user_name    = trim($_POST['user_name'] ?? '');
$user_email   = trim($_POST['user_email'] ?? '');
$user_phone   = trim($_POST['user_phone'] ?? '');
$user_address = trim($_POST['user_address'] ?? '');
$user_city    = trim($_POST['user_city'] ?? '');
$user_notes   = trim($_POST['user_notes'] ?? '');
$remember     = isset($_POST['remember']);

// ----------------------
// 3. CALCULATE TOTAL
// ----------------------
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

// ----------------------
// 4. INSERT ORDER
// ----------------------
$stmt = $conn->prepare("
    INSERT INTO orders 
    (user_id, user_name, user_email, user_phone, user_address, user_city, user_notes, total_price)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param(
    "issssssd",
    $user_id, $user_name, $user_email, $user_phone, $user_address, $user_city, $user_notes, $total_price
);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

// ----------------------
// 5. INSERT ORDER ITEMS
// ----------------------
$stmt = $conn->prepare("
    INSERT INTO order_items (order_id, food_id, food_name, quantity, price)
    VALUES (?, ?, ?, ?, ?)
");
foreach ($_SESSION['cart'] as $food_id => $item) {
    $stmt->bind_param("iisid", $order_id, $food_id, $item['name'], $item['quantity'], $item['price']);
    $stmt->execute();
}
$stmt->close();

// ----------------------
// 6. REMEMBER ME (OPTIONAL)
// ----------------------
if ($remember) {
    $raw_token = bin2hex(random_bytes(32));
    $token_hash = hash('sha256', $raw_token);
    $expires = (new DateTime('+30 days'))->format('Y-m-d H:i:s');

    $stmt = $conn->prepare("UPDATE users SET remember_token = ?, remember_expires = ? WHERE id = ?");
    $stmt->bind_param("ssi", $token_hash, $expires, $user_id);
    $stmt->execute();
    $stmt->close();

    setcookie('foodsite_remember', $raw_token, time() + 60*60*24*30, '/', '', false, true);
} else {
    setcookie('foodsite_remember', '', time() - 3600, '/', '', false, true);
    $stmt = $conn->prepare("UPDATE users SET remember_token = NULL, remember_expires = NULL WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

// ----------------------
// 7. EMAIL CONFIRMATION
// ----------------------
$user_subject = "Order Confirmation - Order #{$order_id}";
$user_html = "<h2>Thank you, {$user_name}!</h2>
<p>Order ID: {$order_id}</p>
<p>Total: $" . number_format($total_price,2) . "</p>
<p>Delivery: {$user_address}, {$user_city}</p>
<p>Phone: {$user_phone}</p>
<p>Notes: {$user_notes}</p>";
send_email($user_email, $user_name, $user_subject, $user_html);

$admin_email = "aounmohsin1009@gmail.com";
$admin_subject = "New Order - #{$order_id}";
$admin_html = "<h2>New Order Received</h2>
<p>Order ID: {$order_id}</p>
<p>Customer: {$user_name}</p>
<p>Email: {$user_email}</p>
<p>Phone: {$user_phone}</p>
<p>Address: {$user_address}, {$user_city}</p>
<ul>";
foreach ($_SESSION['cart'] as $item) {
    $admin_html .= "<li>{$item['name']} — Qty: {$item['quantity']} — $" . number_format($item['price'],2) . "</li>";
}
$admin_html .= "</ul><p>Total: $" . number_format($total_price,2) . "</p>";
send_email($admin_email, "Admin", $admin_subject, $admin_html);

// ----------------------
// 8. CLEAR CART & REDIRECT
// ----------------------
unset($_SESSION['cart']);
header("Location: /pages/order-confirmation.php?order_id={$order_id}");
exit();