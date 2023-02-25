<?php
// person
$name = "Andrej Babiš";
$position = "Generálný ředitěl";

$birthdate = new DateTime("2.9.1954");
$today = new DateTime(date("d.m.Y"));
$age =  ($today->diff($birthdate))->y;

$phone = "+420272192111";
$email = "bossbabis@agrofert.cz";
$lookingForJob = false;

// company
$company = "AGROFERT, a.s.";
$web = "www.agrofert.cz";
$street = "Pyšelská 2327/2";
$psc = "149 00";
$city = "Praha 4 - Chodov";
$country = "Česká republika";
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Business card</title>
</head>

<body>
    <h1>Business card</h1>
    <div class="bussiness-card">
        <div class="avatar-wrapper">
            <img src="./img/logo.png" alt="logo společnosti">
        </div>
        <div class="info-box">
            <div class="portrait-wrapper">
                <img src="./img/portrait.png" alt="portrét osoby">
            </div>
            <div class="person-info">
                <div class="main-info">
                    <h2><?php echo $name ?></h2>
                    <p><?php echo $position ?></p>
                    <p><?php echo $birthdate->format("j.n.Y") . " (" . $age . ")" ?></p>
                </div>
                <div class="contact-info">
                    <p><a href="tel:<?php echo $phone ?>"><?php echo $phone ?></a></p>
                    <p><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></p>
                    <p class="stress"><?php echo $lookingForJob ? "Máro, gdě stě?" : "nikdy neodstupim" ?></p>
                </div>
            </div>
            <div class="company-contact-info">
                <h2><?php echo "$company" ?></h2>
                <div class="address">
                    <p><?php echo $street ?></p>
                    <p><?php echo $psc ?></p>
                    <p><?php echo $city ?></p>
                    <p><?php echo $country ?></p>
                </div>
                <p><a href="https://<?php echo $web ?>"><?php echo $web ?></a></p>
            </div>
        </div>
    </div>
</body>

</html>