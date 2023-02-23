<?php
$jmeno = 'Polina';
$prijmeni = 'Fediaeva';
$vek = '04.08.2002';
$adresa = 'Praha 4';
$telefon = '1234567';
$pozice = 'Director of the firm';
$nazev_firmy = 'Best firm';
$email = 'zzefir.rum@mail.com';
$web = 'www.web.com';
$prace = 'Available for job';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business_card</title>
    <link href='https://fonts.googleapis.com/css?family=Merienda' rel='stylesheet'>
    <link rel="stylesheet" href="style.css" />
</head>


<body>
    <div class="business-card-container">

        <div class="business-card front">

            <div class="front-image"><img src=<?php echo "./pepeRound.png" ?>></div>
            <div class="front-info">
                <h2 class="jmeno"> <?php echo $jmeno; ?> </h2>
                <h2 class="prijmeni"> <?php echo $prijmeni; ?> </h2>
                <p class="vek"> <?php echo $vek; ?> </p>
                <p class="nazev_firmy"> <?php echo $nazev_firmy; ?> </p>
                <p class="pozice"> <?php echo $pozice; ?> </p>
            </div>
        </div>

        <div class="business-card back">
            <p class="adresa"> <?php echo $adresa; ?> </p>
            <p class="telefon"> <?php echo $telefon; ?> </p>
            <p class="email"> <?php echo $email; ?> </p>
            <p class="web"> <?php echo $web; ?> </p>
            <p class="prace"> <?php echo $prace; ?> </p>
        </div>


    </div>

</body>


</html>