<?php
session_start();
require 'config.php'; 

if ($_SESSION['role'] == 'Admin') {
    // View Users
    $stmt = $pdo->query('SELECT * FROM users');
    $users = $stmt->fetchAll();

    foreach ($users as $user) {
        echo 'Username: ' . $user['username'] . ' - Email: ' . $user['email'] . '<br>';
    }

  
}
?>
