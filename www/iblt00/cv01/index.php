<?php

$firstName = 'Tomas';
$lastName = 'Ibl';
$position = 'Student';
$studyProgram = 'Applied Informatics';
$company = 'Prague University of Economics and Business';
$city = 'Prague';
$street = 'nam. W. Churchilla';
$propertyNumber = '1938/4';
$psc = '130 67';
$phone = '+420 666 666 666';
$contactEmail = 'iblt00@vse.cz';
$logo = 'icon.png';

$fullName = $firstName . ' ' . $lastName;
$fullAdress = $street . ' ' . $propertyNumber . ', ' . $psc . ' ' . $city


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>Business Card</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <main class="container">
            <div class="businessCardFront">
                <div class="logo"> 
                    <img src=" <?php echo $logo;?>" alt="picture">
                </div>
                <div class="basicInfo">
                    <div class="name"><?php echo $fullName;?></div>
                    <div class="position"><?php echo $position;?></div>
                    <div class="studyProgram"><?php echo $studyProgram;?></div>
                    <div class="company"><?php echo $company;?></div>
                </div>
            </div>
            <div class="businessCardBack">
                <div class="contactInfo">
                    <div class="phone"><i class="fas fa-phone"></i><?php echo $phone;?></div>
                    <div class="adress"><i class="fas fa-map-marked-alt"></i><?php echo $fullAdress;?></div>
                    <div class="email"><i class="fas fa-envelope"></i><?php echo $contactEmail;?></div>
                </div>
            </div>
        </main>
    </body>
</html>