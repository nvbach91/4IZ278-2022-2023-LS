<?php

$fruits = ['melon', 'orage', 'grape', 'blueberry'];
$animals = ['puppy', 'kitty', 'rabbit', 'squirel'];
$films = ['The Banshees of Inishirima', 'Don\'t look up', 'Lock, stock and two smokking barrels'];
$organizations = ['Alza', 'Rohlik', 'Albert', 'Amazon'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Fruits</h2>
    <ul class="fruits">
        <?php foreach($fruits as $fruit): ?>
            <li><?php echo $fruit; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Animals</h2>
    <ul class="animals">
        <?php foreach($animals as $animal): ?>
            <li><?php echo $animal; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Films</h2>
    <ul class="films">
        <?php foreach($films as $film): ?>
            <li><?php echo $film; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Organizations</h2>
    <ul class="organizations">
        <?php foreach($organizations as $organization): ?>
            <li><?php echo $organization; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>