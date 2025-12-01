<?php
session_start();
include __DIR__ . '/../config/db.php';

if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Thank you for Contacting US! Your message has been sent successfully.";
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }
}

$conn->close();
// Redirect back to the contact page
header("Location: ../pages/contact.php");
exit();
?>