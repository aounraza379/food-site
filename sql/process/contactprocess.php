<?php
session_start();
include __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/mail.php';

if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
         /* 🔶 ADD: Send email AFTER successful DB insert */
        $mailBody = "
            <h2>New Contact Message</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";

        // Admin email (change this to your email)
        send_email(
            'aounmohsin1009@gmail.com',
            'Admin',
            'New Contact Message - FoodSite',
            $mailBody
        );
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