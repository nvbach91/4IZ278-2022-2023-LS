<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thank You</title>
    <link rel="stylesheet" type="text/css" href="./styles/thankYou.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <h1>Order Sent</h1>
    <div class="container thankYou-container">
        <p>Thank you for your order! We have received your order and will process it shortly.</p>
    </div>
</body>
</html>