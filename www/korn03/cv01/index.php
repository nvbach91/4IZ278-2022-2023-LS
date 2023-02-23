<?php
$avatar = 'logo.png';                  
$firstName = 'Nick';
$lastName = 'Korotov';
$title = 'Junior Web Dev';
$company = 'Freelance';
$phone = '+420 774 856 XXX';
$email = 'korotov.nick@gmail.com';
$website = 'https://nikinayzer.github.io/personal_page/';
$websiteShort = 'nikinayzer.github.io/personal_page/';
$available = true;               
$city = 'Praha';
$country = 'Czech Republic';

$address = $country . ', ' . $city;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main class="container">
        <div class="business-card bc-front">
            <div class="column">
                <div class="logo" style="background-image: url(./res/<?php echo $avatar; ?>)"></div>
            </div>
            <div class="column">
                <div class="bc-firstname"><?php echo $firstName; ?></div>
                <div class="bc-lastname"><?php echo $lastName; ?></div>
                <div class="bc-title"><?php echo $title; ?></div>
                <div class="bc-company"><?php echo $company; ?></div>
            </div>
        </div>
        <div class="business-card bc-back">
            <div class="column contacts">
                <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></div>
                <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $phone; ?></div>
                <div class="bc-email"><i class="fas fa-at"></i> <?php echo $email; ?></div>
                <a class="bc-website" href="<?php echo $website;?>"><i class="fas fa-globe"></i> <?php echo $websiteShort; ?></a>
                <div class="bc-available"><?php echo $available ? 'Available for contracts' : 'Not available for contracts'; ?></div>
            </div>
        </div>
    </main>
</body>

</html>