<?php
$name = 'Bořek';
$age = 50;
$balance = 123.45;
$isMarried = true;
$animals = ['lion', 'tiger', 'elephant'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>TITLE</title>
    </head>
    <body>
        <h1>Name: <?php echo $name; ?></h1>
        <h1>Age: <?php echo $age; ?></h1>
        <h1>Balance: <?php echo $balance; ?></h1>
        <h1><?php echo $isMarried; ?></h1>
        <h1><?php var_dump($animals); ?></h1>
    </body>
</html>