<?php

$logo = 'assets/img/logo.svg';
$name = 'Luboš';
$surname = 'Jánský';
$birthDate = '2021-03-07';
$jobTitle = 'Consultant';
$street = 'nám. W. Churchilla';
$number = 1938;
$orientationNumber = 4;
$city = 'Praha 3';
$postNumber = 13067;
$phone = '+420 123 456 789';
$mail = 'janl22@vse.cz';
$webPade = 'https://fis.vse.cz/';
$openForWork = true;

if (!is_null($orientationNumber)) {

    $address = $street . ' ' . $number . '/' . $orientationNumber . ', ' . substr($postNumber, 0, 3) . ' ' . substr($postNumber, 3, 2) . ' ' . $city;

} else {

    $address = $street . ' ' . $number . ', ' . substr($postNumber, 0, 3) . ' ' . substr($postNumber, 3, 2) . ' ' . $city;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"/>
    <title>Business Card</title>
</head>
<body>
<div class="container">
    <div class="mt-5 d-flex justify-content-center">
        <div class="row col-md-6 business-card">
                <div class="col-md-4 text-end">
                    <img src="<?php echo $logo ?>" class="logo-front me-3">
                </div>
                <p class="col-md-8 text-start">
                    <span class="name"><?php echo $name ?></span><br>
                    <span class="surname"><?php echo $surname ?></span><br>
                    <span class="jobTitle"><?php echo $jobTitle ?></span>
                </p>
        </div>
    </div>
    <div class="mt-5 d-flex justify-content-center">
        <div class="row col-md-6 business-card">
            <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-2 text-end ">
                    <img src="<?php echo $logo ?>" class="logo-back">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <p class="address mb-1"><i class="fa-solid fa-map-location-dot"></i> <?php echo $address ?></p>
                    <p class="phone mb-1"><i class="fa-solid fa-phone"></i> <?php echo $phone ?></p>
                    <p class="mail mb-1"><i class="fa-solid fa-at"></i> <?php echo $mail ?></p>
                    <p class="webPage mb-1"><i class="fa-solid fa-globe"></i> <?php echo $webPade ?></p>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex align-items-end openForWork"><?php if($openForWork) {echo 'Now open for contracts';}?></div>
                <div class="col-md-4"></div>
                <div class="col-md-2 text-end ">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&margin=0&color=ffffff&bgcolor=172933&data=<?php echo $webPade ?>" class="qr-code">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
</body>
</html>