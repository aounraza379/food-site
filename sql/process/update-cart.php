<?php
session_start();
require __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $food_id = (int) $_POST['food_id'];
    $action = $_POST['action'];
    
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        
        if ($action === 'update') {
            $quantity = (int) $_POST['quantity'];
            
            // Update in database
            $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND food_id = ?");
            $stmt->bind_param("iii", $quantity, $user_id, $food_id);
            $stmt->execute();
            
            // Update session
            if (isset($_SESSION['cart'][$food_id])) {
                $_SESSION['cart'][$food_id]['quantity'] = $quantity;
            }
            
        } elseif ($action === 'remove') {
            // Remove from database
            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND food_id = ?");
            $stmt->bind_param("ii", $user_id, $food_id);
            $stmt->execute();
            
            // Remove from session
            unset($_SESSION['cart'][$food_id]);
        }
        $stmt->close();
    } else {
        // Guest user - update session only
        if ($action === 'update') {
            $quantity = (int) $_POST['quantity'];
            if (isset($_SESSION['cart'][$food_id])) {
                $_SESSION['cart'][$food_id]['quantity'] = $quantity;
            }
        } elseif ($action === 'remove') {
            unset($_SESSION['cart'][$food_id]);
        }
    }
    
    header("Location: /pages/cart.php");
    exit();
}