<?php
$name = 'Samuel Biros';
$avatar = 'corridor.png';
$phone = '+421 918 292 368';
$age = floor((time() - strtotime('1998-10-29')) / 31556926);
$profession = 'Motion Designer';
$company = 'Corridor Digital';
$street = 'Vlada Clementisa';
$numberstreet = '13';
$numbercity = '08 001';
$city = 'Presov';
$email = 'birossamuel613@gmail.com';
$web = 'www.corridordigital.com';
$available = false;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class='title'>My business card in PHP</div>
        <div class="card front">
            <div class="bc-avatar"><img src=<?php echo $avatar?> width="150"></div>
            <div class="bc-name"><?php echo $name?></div>
            <div class="bc-vek"><?php echo $age . ' years old'?></div>
            <div class="bc-povolanie"><?php echo $profession?></div>
            <div class="bc-firma"><?php echo $company?></div>
        </div>
        <div class="card back">
            <div class="bc-adresa"><?php echo $street . ' ' .$numberstreet . ', ' . $city?></div>
            <div class="bc-phone"><?php echo $phone?></div>
            <div class="bc-email"><?php echo $email?></div>
            <div class="bc-web"><?php echo $web?></div>
            <div class="bc-available"><?php echo $available ? 'Available for contracts' : 'Not available for contracts';?></div>
        </div>
    </body>
</html>