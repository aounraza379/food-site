<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function send_email($to, $name, $subject, $html) {

    $mail = new PHPMailer(true);

    try {
        // SMTP setup
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aounmohsin1009@gmail.com';
        $mail->Password = 'jyeexavyuptdmlal';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('aounmohsin1009@gmail.com', 'Foodsite');
        $mail->addAddress($to, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $html;

        return $mail->send();
    } catch (Exception $e) {
        // Log errors to help debug
        error_log("MAIL ERROR: " . $mail->ErrorInfo);
        return false;
    }
}