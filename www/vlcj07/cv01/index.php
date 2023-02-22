<?php

/**
 * Avatar nebo Logo
*Příjmení
*Jméno
*Věk (výpočet z datumu narození)
*Povolání nebo Pozice
*Název firmy
*Ulice
*Číslo popisné
*Číslo orientační
*Město
*Telefon
*E-mail
*Adresa webové stránky
*Zda sháníte práci (Boolean)
 */

$name = 'Otto Chairman';

//date in dd/mm/yyyy format
$birthDate = "17/12/1983";
//explode the date to get month, day and year
$birthDate = explode("/", $birthDate);
//get age from date or birthdate
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
  ? ((date("Y") - $birthDate[2]) - 1)
  : (date("Y") - $birthDate[2]));

$jobPosition = 'Pizza Chef';

$companyName = 'Risottiamo';

$adress = 'Joe Street 1, 10005 Namibia';

$phoneNumber = '+420 725 888 777';

$email = 'otto.chairman@risottiamo.com';

$website = 'www.risottiamo.com';

$lookingForJob = false;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otto's Business Card</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class=business-card>
        <div class="business-card-frontside">
            <div class="logo"><img class="picture" src="Pizza-logo-transparent-PNG.png" ></div>
            <div class=company-name><?php     echo $companyName; ?></div>
        </div>
        <div class="business-card-backside">
            <div class="bc-left-side">
                <div class="name"><?php    echo $name; ?></div>
                <div class="age"><?php     echo "Age: " . $age; ?></div>
                <div class="job-position"><?php     echo $jobPosition; ?></div>
            </div>
            <div class="bc-right-side">
                <div class="adress"><?php     echo $adress; ?></div>
                <div class="phone-number"><?php     echo $phoneNumber; ?></div>
                <div class="email"><?php     echo $email; ?></div>
                <div class="website"><?php     echo $website; ?></div>
                <div class="looking-for-job"><?php     echo $lookingForJob ? 'Looking for new job' : 'Not looking for new job'; ?></div>
            </div>
        </div>
    </div>
    
    

        
</body>
</html>