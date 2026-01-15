<?php
session_start();
require __DIR__ . '/../config/db.php';

function migrateGuestCartToUser($user_id, $conn) {
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $food_id => $item) {
            // Check if item exists in user's cart
            $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = ? AND food_id = ?");
            $stmt->bind_param("ii", $user_id, $food_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Update quantity
                $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND food_id = ?");
                $stmt->bind_param("iii", $item['quantity'], $user_id, $food_id);
            } else {
                // Insert new item
                $stmt = $conn->prepare("INSERT INTO cart (user_id, food_id, quantity) VALUES (?, ?, ?)");
                $stmt->bind_param("iii", $user_id, $food_id, $item['quantity']);
            }
            $stmt->execute();
            $stmt->close();
        }
    }
}