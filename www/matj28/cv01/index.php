<?php

$name = 'Jan';
$surname = 'Matura';
$born = new DateTime('2000-04-12');
$job = 'Java developer';
$practise= 2;
$company = 'Commerzbank';
$adress = 'Jenstejnska';
$homeNumber = 1735;
$detailedNumber = 2;
$city = 'Prague';
$tel = 774736704;
$email = 'jan-matura@seznam.cz';
$web = 'https://ai.com';
$freeAgent = false;
$current_date = new DateTime();
$age = $born->diff($current_date)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X=UA=COmpatible">
    <meta name="viewport">
    <title>Lepší než ISIC</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
<div class="bCard">
    <div class="logo"></div>
    <h1><?php echo "$name $surname"; ?></h1>
    <p>Age: <?php echo $age->format('%Y years') ?></p>
    <p>tel: <?php echo $tel ?></p>
    <p>e-mail:  <?php echo $email ?></p>
    <p>Web: <?php echo "<a href=$web>$web</a>"?></p>
</div>

<br>

<div class="bCard">
    <h3>
        <?php
        if ($freeAgent){
            echo 'Hledam praci';
        } else {
            echo 'Zaměstnaný';
        }
        ?>
    </h3>
    <p><?php echo $job ?></p>
    <p> <?php echo $practise ?> years of experience</p>
    <p> <?php echo $company ?> </p>
    <p> <?php echo "$adress $homeNumber/$detailedNumber, $city"?></p>


</div>
</body>
</html>
