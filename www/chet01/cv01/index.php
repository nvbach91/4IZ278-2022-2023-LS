<?php 
$name = "Tatiana Chesebieva";
$title = "Front end developer";
$title2 = "Web dev student";
$unemployed = false;
$adress = "Prague, Czech republic";
$tel = 123456789;
$email = "t.chess@gmail.com";
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
    <div class="card">
        <div class="box">
            <h1><?= $name ?></h1>
            <p>
                <?php
                if ($unemployed){
                    echo $title2;
                } else {
                    echo $title;
                }
                ?>
            </p>
            <div class="line">
                <img src="https://icons.veryicon.com/png/o/miscellaneous/icon_1/address-60.png">
                <span><?= $adress ?></span>
            </div>
            <div class="line">
                <img src="https://cdn1.iconfinder.com/data/icons/material-communication/18/phone-512.png">
                <span><?= $tel ?></span>
            </div>
            <div class="line">
                <img src="https://www.svgrepo.com/download/285/email.svg">
                <span><?= $email ?></span>
            </div>
        </div>
    </div>
</body>
</html>