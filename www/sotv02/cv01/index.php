<?php
$bcName = 'Rick Astley';
$bcQuote = 'Never Gonna Give You Up';
$bcDate = 'February 6 1966';
$bcOccupation = 'Musician';
$bcActiveYears = "1985 – NOW";
$bcStyles = "Soul, POP, Eurobeat";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <div class="business-card">
        <div class="image">
            <img class="rick" src="assets/img/astley.png" alt="rick_astley">
        </div>
        <div class="content">
            <div class="title">
                <span class="bc-name"><?php echo $bcName; ?></span>
                <span class="bc-quote"><?php echo $bcQuote; ?></span>
            </div>
            <div class="info">
                <span class="bc-occupation"><?php echo $bcOccupation; ?></span>
                <span class="bc-date"><?php echo $bcDate; ?></span>
                <span class="bc-acyears"><?php echo $bcActiveYears; ?></span>
                <span class="bc-styles"><?php echo $bcStyles; ?></span>
            </div>
            <div class="qr">
                <img class="roll" src="assets/img/qrcode.png" alt="rickroll">
            </div>
        </div>
    </div>
</body>
</html>