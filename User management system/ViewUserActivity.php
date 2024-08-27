<?php
session_start();
require 'config.php';

if ($_SESSION['role'] == 'Admin') {
    $stmt = $pdo->query('SELECT * FROM activity_logs');
    $logs = $stmt->fetchAll();

    foreach ($logs as $log) {
        echo 'User ID: ' . $log['user_id'] . ' - Action: ' . $log['action'] . ' - Timestamp: ' . $log['timestamp'] . '<br>';
    }
}
?>
