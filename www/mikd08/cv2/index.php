<?php

$fruits = ["melon", "orange",  "grape", "blueberry"];
$films = ["avengers", "john wick",  "f&f", "titanic"];
$animals = ["dog", "cat",  "fish", "hippo"];
$orgs = ["google", "meta",  "idk", "hahahah"];



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
    <h1>php cv 2</h1>
    <?php var_dump($fruits);?>
    <ul>
        <?php foreach($fruits as $fruit):?>
            <li><?php echo $fruit?></li>
        <?php endforeach?>
    </ul>
    <ul>
        <?php foreach($orgs as $org):?>
            <li><?php echo $org?></li>
        <?php endforeach?>
    </ul>
    <ul>
        <?php foreach($animals as $animal):?>
            <li><?php echo $animal?></li>
        <?php endforeach?>
    </ul>
    <ul>
        <?php foreach($films as $film):?>
            <li><?php echo $film?></li>
        <?php endforeach?>
    </ul>
</body>
</html>