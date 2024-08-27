<?php
require 'congig.php'; 

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify token and activate account
    $stmt = $pdo->prepare('SELECT * FROM users WHERE activation_token = ?');
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        $stmt = $pdo->prepare('UPDATE users SET activation_token = NULL WHERE id = ?');
        $stmt->execute([$user['id']]);
        echo 'Account activated successfully!';
    } else {
        echo 'Invalid activation token!';
    }
} else {
    echo 'No activation token provided!';
}
?>
