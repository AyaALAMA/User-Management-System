<?php
session_start();
require 'config.php';

if ($_SESSION['role'] == 'Admin') {
    $search = $_GET['search'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username LIKE ? OR email LIKE ?');
    $stmt->execute(['%' . $search . '%', '%' . $search . '%']);
    $users = $stmt->fetchAll();

    foreach ($users as $user) {
        echo 'Username: ' . $user['username'] . ' - Email: ' . $user['email'] . '<br>';
    }
}
?>
