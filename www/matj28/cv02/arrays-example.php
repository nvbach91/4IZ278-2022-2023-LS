<?php
$fruits = ['mango', 'blueberry', 'melon', 'orange'];
$languages = ['en', 'cz', 'ru'];
$spheresAvg = [6];
$nothings = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X=UA=COmpatible">
    <meta name="viewport">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
<h2>Fruits</h2>
<ul>
    <?php foreach($fruits as $fruit): ?>
    <li><?php echo $fruit; ?></li>
    <?php endforeach; ?>
</ul>
<h2>?</h2>
<ul>
    <?php foreach($nothings as $nothing): ?>
        <li><?php echo $nothing; ?></li>
    <?php endforeach; ?>
</ul>
<h2>Languages</h2>
<ul>
    <?php foreach($languages as $language): ?>
        <li><?php echo $language; ?></li>
    <?php endforeach; ?>
</ul>
<h2>Sphere avereges</h2>
<ul>
    <?php foreach($spheresAvg as $avg): ?>
        <li><?php echo $avg; ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>