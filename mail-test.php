<?php
require __DIR__ . '/config/mail.php';

// Test send
$to = 'aounmohsin1009@gmail.com'; // any test email
$subject = 'Foodsite SMTP Test';
$body = '<p>This is a test email from Foodsite SMTP setup.</p>';
$res = send_email($to, 'Test Recipient', $subject, $body);
if ($res === true) {
    echo "Mail sent successfully.";
} else {
    echo "Mail error: " . htmlspecialchars($res);
}