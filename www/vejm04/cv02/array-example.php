<?php
$fruits = ['mango','blueberry','melon'];
$people = ['marek','lukas','petr','mila','jan'];
$single = ['sad'];
$empty = [];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <ul>
            <?php foreach($fruits as $fruit): ?>
                <li><?php echo $fruit; ?></li>
            <?php endforeach; ?>
        </ul>
        <ul>
            <?php foreach($people as $man): ?>
                <li><?php echo $man; ?></li>
            <?php endforeach; ?>
        </ul>
        <ul>
            <?php foreach($single as $s): ?>
                <li><?php echo $s; ?></li>
            <?php endforeach; ?>
        </ul>
        <ul>
            <?php foreach($empty as $e): ?>
                <li><?php echo $e; ?></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>