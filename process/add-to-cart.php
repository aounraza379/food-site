<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['HTTP_REFERER'];
    header("Location: /pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity
        ];
    }

    header("Location: /pages/menu.php");
    exit();
} else {
    header("Location: /pages/menu.php");
    exit();
}