<?php

require './Person.php';

$person1 = new Person(
    "Tatiana Chesebieva",
    "Front end developer",
    "Web dev student",
    false,
    "Prague, Czech republic",
    123456789,
    "t.chess@gmail.com",
    1998
);
$person2 = new Person(
    "Jan Novak",
    "Back end developer",
    "Unemployed",
    true,
    "Brno, Czech republic",
    123456789,
    "kj.nvk@gmail.com",
    1988
);

$people = [$person1, $person2]
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizitka</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php foreach ($people as $person) : ?>
        <div class="card">
            <div class="box">
                <h1><?= $person->name ?></h1>
                <p>
                    <?php
                    if ($person->unemployed) {
                        echo $person->title2;
                    } else {
                        echo $person->title;
                    }
                    ?>
                </p>
                <div class="line">
                    <img src="https://icons.veryicon.com/png/o/miscellaneous/icon_1/address-60.png">
                    <span><?= $person->adress ?></span>
                </div>
                <div class="line">
                    <img src="https://cdn1.iconfinder.com/data/icons/material-communication/18/phone-512.png">
                    <span><?= $person->tel ?></span>
                </div>
                <div class="line">
                    <img src="https://www.svgrepo.com/download/285/email.svg">
                    <span><?= $person->email ?></span>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</body>

</html>