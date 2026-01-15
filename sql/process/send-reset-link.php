<?php
require_once "../config/db.php";
require_once "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_POST['email'])) {
    header("Location: ../pages/forgot-password.php?error=1");
    exit;
}

$email = trim($_POST['email']);

// 1. Check if user exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: ../pages/forgot-password.php?error=1");
    exit;
}

$user = $result->fetch_assoc();

// 2. Generate token
$token   = bin2hex(random_bytes(32));
$expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

// 3. Save token
$update = $conn->prepare(
    "UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?"
);
$update->bind_param("sss", $token, $expires, $email);
$update->execute();

// 4. Build reset link
$resetLink = "http://foodsite.com/pages/reset-password.php?token=$token";

// 5. Send email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;
    $mail->Username   = "aounmohsin1009@gmail.com";
    $mail->Password   = "jyeexavyuptdmlal";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom("aounmohsin1009@gmail.com", "Food Paradise");
    $mail->addAddress($email);

    $mail->Subject = "Reset Your Password";
    $mail->Body    = "Click the link below to reset your password:\n\n$resetLink\n\nThis link expires in 1 hour.";

    $mail->send();

    header("Location: ../pages/forgot-password.php?success=1");
    exit;

} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}