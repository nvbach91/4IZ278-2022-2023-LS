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
                <div -class="main-info">
                    <?php
                    echo "<h2>$name</h2>";
                    echo "<p>$position</p>";
                    echo "<p>" . $birthdate->format("j.n.Y") . " (" . $age . ")</p>"
                    ?>
                </div>
                <div class="contact-info">
                    <?php
                    echo "<p><a href=tel:" . $phone . ">" . $phone . "</a></p>";
                    echo "<p><a href=mailto:" . $email . ">" . $email . "</a></p>";
                    echo  $lookingForJob ? "<p>Máro, gdě stě?</p>" : "<p class=\"nechsitovsecizapamatuji\">nikdy neodstupim</p>";
                    ?>
                </div>
            </div>
            <div class="company-contact-info">
                <h2><?php echo "$company" ?></h2>
                <div class="address">
                    <?php
                    echo "<p>" . $street . "</p>";
                    echo "<p>" . $psc . "</p>";
                    echo "<p>" . $city . "</p>";
                    echo "<p>" . $country . "</p>";
                    ?>
                </div>
                <p><a href="https://<?php echo $web ?>"><?php echo "$web" ?></a></p>
            </div>
        </div>
    </div>
</body>

</html>