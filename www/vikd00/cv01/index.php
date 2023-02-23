<?php
$logo = "avatar.png";
$firstName = "David";
$lastName = "Vikor";
$age = "22";
$profession = "Programmer";
$company = "Never ending development s.r.o";
$street = "Hlavná";
$descStreetNum = "234";
$orientStreetNum = "12";
$city = "Praha";
$phone = "+420 788 342 391";
$email = "vikd00@vse.cz";
$website = "davidvikor.com";
$lookingForJob = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizitka</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="card-front">
        <div class="image">
            <img src="<?php echo $logo ?>">
        </div>
        <div class="front-content">
            <p><?php echo $firstName . " " . $lastName ?></p>
            <p><?php echo $age . " years old" ?></p>
            <p><?php echo $profession . " at " . $company ?></p>
        </div>
    </div>
    <div class="card-back">
        <div class="back-content">
            <p><?php echo $phone ?></p>
            <p><?php echo $email ?></p>
            <p><?php echo $website ?></p>
            <p><?php echo $street . " " . $descStreetNum . "/" . $orientStreetNum . " " . $city ?></p>
            <p><?php echo ($lookingForJob ? "Available" : "Unavailable") ?></p>
        </div>
    </div>
</body>

</html>