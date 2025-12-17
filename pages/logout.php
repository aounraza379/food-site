<?php
session_start();
require __DIR__ . '/../config/db.php';

// clear remember token in DB for this user (if logged)
if (isset($_SESSION['user']['id'])) {
    $stmt = $conn->prepare("UPDATE users SET remember_token = NULL, remember_expires = NULL WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user']['id']);
    $stmt->execute();
    $stmt->close();
}

$_SESSION = [];
setcookie('foodsite_remember', '', time() - 3600, '/', '', false, true);
session_destroy();
header("Location: /index.php");
exit;