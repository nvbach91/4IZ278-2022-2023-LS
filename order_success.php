<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Potvrdenie Objednávky</title>
    <?php include 'meta.php'; ?>
</head>
<body>
    <?php include 'header.php';?>

    <h1>Objednávka bola úspešne vytvorená.</h1>
    <p>Objednávka bola vytvorená o stave objednávky vás budeme informovať emailom.</p>


    <button onclick="location.href='account.php'">Sledovať moju objednávku</button>

    <?php include 'footer.php';?>
</body>
</html>
