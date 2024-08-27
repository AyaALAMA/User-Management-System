<?php
session_start();
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
    $stmt->execute([$username, $email, $user_id]);

    echo 'Profile updated successfully!';
}
?>
