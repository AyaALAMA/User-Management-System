<?php
session_start();
require 'config.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare('
    SELECT roles.role_name, permissions.permission_name 
    FROM user_roles 
    JOIN roles ON user_roles.role_id = roles.id 
    JOIN role_permissions ON roles.id = role_permissions.role_id 
    JOIN permissions ON role_permissions.permission_id = permissions.id 
    WHERE user_roles.user_id = ?
');
$stmt->execute([$user_id]);
$roles_permissions = $stmt->fetchAll();

foreach ($roles_permissions as $rp) {
    echo 'Role: ' . $rp['role_name'] . ' - Permission: ' . $rp['permission_name'] . '<br>';
}
?>
