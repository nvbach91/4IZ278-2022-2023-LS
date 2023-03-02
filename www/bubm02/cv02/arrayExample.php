<?php

$fruits = ['melon', 'orange', 'grape', 'blueberry'];
$animals = ['dog', 'cat', 'mouse', 'horse'];
$organizations = ['Apple', 'Microsoft', 'Google', 'Facebook'];
$films = ['Interstellar', 'Inception', 'The Dark Knight', 'The Prestige'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: black; color: white;">
    <div>
        <h1>My favourite fruits</h1>
        <ul>
            <?php
            foreach ($fruits as $fruit):?>
                <li><?php echo "$fruit"?></li>
            <?php endforeach?>
        </ul>
        <h1>My favourite animals</h1>
        <ul>
        <?php
            foreach ($animals as $animal):?>
                <li><?php echo "$animal"?></li>
            <?php endforeach?>
        </ul>
        <h1>Worst organizations</h1>
        <ul>
        <?php
            foreach ($organizations as $organization):?>
                <li><?php echo "$organization"?></li>
            <?php endforeach?>
        </ul>
        <h1>My favourite films</h1>
        <ul>
        <?php
            foreach ($films as $film):?>
                <li><?php echo "$film"?></li>
            <?php endforeach?>
        </ul>
    </div>
</body>
</html>