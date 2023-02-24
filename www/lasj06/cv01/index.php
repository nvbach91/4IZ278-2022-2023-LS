<?php

$logo = 'img/logo.png';
$name = 'Jiří Láska';
$age = date_diff(date_create('2000/12/12'), date_create('now'))->y;
$position = 'Student';
$companyName = 'Vysoká škola ekonomická v Praze';
$address = 'Štorkánova 2808/12';
$cityName = 'Praha 5';
$phone = '+420 607 076 066';
$mail = 'jirka@lasci.cz';
$webAddress = 'esotemp.vse.cz/lasj06/cv01';
$isLookingForWork = false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="main">
        <div class="main-info">
            <img class="logo" src="<?php echo $logo; ?>" width="30px" height="20px">
            <p><?php echo $name ?></p>
            <p><?php echo $age ?></p>
            <p><?php echo $position ?></p>
            <p><?php echo $companyName ?></p>
        </div>
        <div class="address">
            <p><?php echo $cityName ?></p>
            <p><?php echo $address ?></p>
        </div>
        <div class="contact">
            <p><?php echo $mail ?></p>
            <p><?php echo $phone ?></p>
            <?php echo $webAddress ?>
            <p><?php
                if ($isLookingForWork == false) {
                    echo "Nehledám zaměstnání";
                } else {
                    echo "Hledám zaměstnání";
                }
            ?></p>
        </div>
    </div>
</body>
</html>