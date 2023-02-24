<?php

$animals=['lion','tiger','elephant'];
$name='Michelle Obama';
$jmeno='Patrik';                                //Done
$prijmeni='Šmátrala';                           //Done
$age=0;                                         //Done
$dateOfBirth='20/05/2000';
$position='Student';                            //Done
$company='Vysoká škola ekonomická v Praze';     //Done
$streetName='Nám. Winstona Churchilla';         //Done
$cisloPopisne='1938';                           //Done
$cisloOrientacni='4';                           //Done
$city='120 00 Praha 3-Žižkov';                  //Done
$telephone='+420 737 448 746';                  //Done
$email='smap01@vse.cz';                         //Done
$webPage='esotemp.vse.cz/~smap01/cv01';         //Done
$isJobless=false;                               //Done
$dateOfBirth = explode("/", $dateOfBirth);
$age=(date('md', date('U', mktime(0, 0, 0, $dateOfBirth[1], $dateOfBirth[0], $dateOfBirth[2]))) > date('md')?((date('Y')-$dateOfBirth[2])-1):(date('Y')-$dateOfBirth[2]));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Business card</title>
        <link rel="stylesheet" href="./css/stylesheet.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
        <div class='paper'>
            <div class='business_card front_page'>
                <div class='logo info'><img src="./img/user_avatar.png"></img></div>
                <div class='col-sm-4 info'>
                    <div class='bc-lastname'><h2><?php echo $prijmeni?></h2></div>
                    <div class='bc-firstname'><h2><?php echo $jmeno?></h2></div>
                    <div class='bc-position'><h3><?php echo $position."&nbsp;&nbsp;&nbsp;&nbsp;".$age.' years old'?></h3></div>
                    <div class='bc-company'><h3><?php echo $company?></h3></div>
                </div>
            </div>
            <div class='business_card'>
                <div class='col-1 info'>
                    <img style='width:100%;' src='./img/logo_company.png'></img>
                </div>
                <div class='col-0 info'>
                    <div class='bc-address'><i class='fas fa-map-marker-alt'></i> <?php echo $streetName.' '.$cisloPopisne.'/'.$cisloOrientacni.', '.$city ?></div>
                    <div class='bc-telephone'><i class='fas fa-phone'></i> <?php echo $telephone?></div>
                    <div class='bc-email'><i class='fas fa-solid fa-envelope'></i> <?php echo $email?></div>
                    <div class='bc-webpage'><i class='fas fa-solid fa-globe'></i> <?php echo $webPage?></div>
                    <div class="bc-available"><?php echo $isJobless ? 'Now available for contracts' : 'Not available for contracts'; ?></div>
                </div>
            </div>
        </div>
    </body>
</html>