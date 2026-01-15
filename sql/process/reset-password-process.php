<?php
require_once "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/login.php");
    exit;
}

$token = $_POST['token'] ?? '';
$password = $_POST['password'] ?? '';

if (!$token || !$password) {
    die("Invalid request.");
}

$now = date("Y-m-d H:i:s");

$stmt = $conn->prepare("
    SELECT id 
    FROM users 
    WHERE reset_token = ?
      AND reset_expires > ?
");
$stmt->bind_param("ss", $token, $now);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Reset link expired.");
}

$user = $result->fetch_assoc();
$hashed = password_hash($password, PASSWORD_BCRYPT);

$update = $conn->prepare("
    UPDATE users 
    SET password = ?, reset_token = NULL, reset_expires = NULL
    WHERE id = ?
");
$update->bind_param("si", $hashed, $user['id']);
$update->execute();

header("Location: ../pages/login.php?reset=success");
exit;