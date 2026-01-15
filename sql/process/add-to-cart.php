<?php
session_start();
require __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    $name = $_POST['name'];
    $price = (float) $_POST['price'];
    $quantity = (int) $_POST['quantity'];

    // Initialize cart session if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // If user is logged in, store in database
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        
        // Check if item already exists in cart
        $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = ? AND food_id = ?");
        $stmt->bind_param("ii", $user_id, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Update quantity
            $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND food_id = ?");
            $stmt->bind_param("iii", $quantity, $user_id, $id);
        } else {
            // Insert new item
            $stmt = $conn->prepare("INSERT INTO cart (user_id, food_id, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $user_id, $id, $quantity);
        }
        $stmt->execute();
        $stmt->close();
        
        // Also update session for immediate display
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ];
        }
    } else {
        // Guest user - store only in session
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ];
        }
        
        // Redirect to login if trying to checkout as guest
        $_SESSION['redirect_after_login'] = $_SERVER['HTTP_REFERER'] ?? '/pages/menu.php';
    }

    $redirect = $_SERVER['HTTP_REFERER'] ?? '/pages/menu.php';
    header("Location: $redirect");
    exit();
}