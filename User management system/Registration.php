<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(50));

    
    $stmt = $pdo->prepare('INSERT INTO users (username, email, password, activation_token) VALUES (?, ?, ?, ?)');
    $stmt->execute([$username, $email, $password, $token]);

    
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
