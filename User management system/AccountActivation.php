<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50));
 
    $mail = new PHPMailer(true);
    try {
        $mail->setFrom('no-reply@example.com', 'User Management System');
        $mail->addAddress($email);
        $mail->Subject = 'Account Activation';
        $mail->Body = 'Click the link to activate your account: http://example.com/activate.php?token=' . $token;
        $mail->send();
        echo 'Activation email sent!';
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>
