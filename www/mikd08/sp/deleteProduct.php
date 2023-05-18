<?php
if (!empty($_POST['product_id'])) {
    require_once 'db.php';

    $stmt = $pdo->prepare('DELETE FROM product WHERE product_id = :product_id');
    $stmt->execute(['product_id' => $_POST['product_id']]);
}

    header('Location: index.php');

?>