<?php
session_start();
require 'config.php';

if ($_SESSION['role'] == 'Admin') {
    $limit = 10;
    $page = $_GET['page'] ?? 1;
    $offset = ($page - 1) * $limit;

    $stmt = $pdo->prepare('SELECT * FROM users LIMIT ? OFFSET ?');
    $stmt->execute([$limit, $offset]);
    $users = $stmt->fetchAll();

    foreach ($users as $user) {
        echo 'Username: ' . $user['username'] . ' - Email: ' . $user['email'] . '<br>';
    }

    // Pagination links
    $stmt = $pdo->query('SELECT COUNT(*) FROM users');
    $total_users = $stmt->fetchColumn();
    $total_pages = ceil($total_users / $limit);

    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<li class="page-item' . ($i == $page ? ' active' : '') . '">';
        echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}
?>
