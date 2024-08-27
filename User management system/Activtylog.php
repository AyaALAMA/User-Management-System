<?php
function logActivity($user_id, $action) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO activity_logs (user_id, action) VALUES (?, ?)');
    $stmt->execute([$user_id, $action]);
}
?>
