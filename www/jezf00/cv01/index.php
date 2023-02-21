<?php

// this is a one-line comment

/*
this is a multiline
comment
*/


// variable declaration and initialization

$avatar = 'widepeepoHappy.png';                  // data type string
$firstName = 'Filip';
$lastName = 'Ježek';
$title = 'CEO';
$company = 'Dreamtrender';
$phone = '+421 902 384 569';
$email = 'jezek@dreamtrender.com';
$website = 'www.dreamtrender.com';
$available = false;                         // data type boolean
$street = 'Mládežnícká';
$propertyNumber = 406;                       // datatype integer number
$orientationNumber = 90880;
$city = 'Sekule';
$bankBalance = 1217412.420;                 // datatype double/float
$currency = 'CZK';
$datum_nar='2001-10-03';
$dn = new DateTime($datum_nar);
$dnes = new DateTime();
$rozdiel = date_diff($dn, $dnes);
$vek=$rozdiel->y;

// string concatenation
$address = $street . ' ' . $propertyNumber . '/' . $orientationNumber . ', ' . $city;

// string variable interpolation
$address = "$street $propertyNumber/$orientationNumber, $city";
$address = "{$street} {$propertyNumber}/{$orientationNumber}, {$city}";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="container">
        <h1 class="text-center">My Business Card in PHP</h1>
        <div class="business-card bc-front row">
            <div class="col-sm-4">
                <div class="logo" style="background-image: url(<?php echo $avatar; ?>)"></div>
            </div>
            <div class="col-sm-8">
                <div class="bc-firstname"><?php echo $firstName; ?></div>
                <div class="bc-lastname"><?php echo $lastName; ?></div>
                <div class="bc-title"><?php echo $title; ?></div>
                <div class="bc-company"><?php echo $company; ?></div>
            </div>
        </div>
        <div class="business-card bc-back row">
            <div class="col-sm-6">
                <div class="bc-firstname"><?php echo $firstName; ?></div>
                <div class="bc-lastname"><?php echo $lastName; ?></div>
                <div class="bc-title"><?php echo $title;?></div>
            </div>
            <div class="col-sm-6 contacts">
                <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></div>

                <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $phone; ?></div>
                <div class="bc-email"><i class="fas fa-at"></i> <?php echo $email; ?></div>
                <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $website; ?></div>
                <div class="age"><i class="fa fa-calendar"></i> <?php echo $datum_nar; echo " (".$vek.")"; ?></div>
                <div class="bc-available"><?php echo $available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>

</html>