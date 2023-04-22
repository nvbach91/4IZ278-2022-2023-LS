<?php
if (!empty($_GET['good_id'])) {
    require_once 'db.php';

    $stmt = $pdo->prepare('DELETE FROM cv09_goods WHERE good_id = :good_id');
    $stmt->execute(['good_id' => $_GET['good_id']]);

    header('Location: ./index.php');
    exit;
} else {
    header('Location: ./index.php');
    exit;
}

?>