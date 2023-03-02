<?php


$avatar = 'cervena-karkulka.jpg';
$firstName = 'Červená';
$lastName = 'Karkulka';
$title = 'Nositelka dobrot pro babičku';
$company = 'Babiččiny dobroty';
$phone = '+420 444 222 000';
$email = 'cervenakarkulka@hluboky-les.com';
$website = 'www.hluboky-les.com';
$available = false;
$street = 'Úplně pusto';
$propertyNumber = 77;
$orientationNumber = 155;
$city = 'Les';
$bankBalance = 1217412.420;
$birthYear = 2000;

// string concatenation
$address = $street . ' ' . $propertyNumber . '/' . $orientationNumber . ', ' . $city;

function calculateAge($birthYear){
    $age = 2023 - $birthYear;
    return ($age);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vizitka</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main class="container">
        <h1 class="text-center">Vizitka v PHP</h1>
        <div class="business-card bc-front row">
            <div class="col-sm-4">
                <div class="logo" style="background-image: url(./img/<?php echo $avatar; ?>)"></div>
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
                <div class="bc-title"><?php echo $title ?></div>
            </div>
            <div class="col-sm-6 contacts">
                <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></div>
                <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $phone; ?></div>
                <div class="bc-email"><i class="fas fa-at"></i> <?php echo $email; ?></div>
                <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $website; ?></div>
                <div class="bc-available"><?php echo $available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
                <div class="bc-age"><?php echo calculateAge($birthYear); ?></div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>

</html>