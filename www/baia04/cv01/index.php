<?php

// files
$styles = 'style.css';
$logo = 'icon.png';
$qrcode = 'qrcode.svg';
$place_icon = 'place_icon.svg';
$phone_icon = 'phone_icon.svg';
$at_icon = 'at_icon.svg';
$web_icon = 'web_icon.svg';

// variables
$name = 'David';
$lastname = 'Novák';
$age = 25;
$position = 'Chief Executive Officer';
$company_name = 'PixelWave Tech.';
$adress = '110 00 Prague, Czech Republic, Prague 1, Vodičkova 791/41';
$phone_number = '987-654-321';
$website = 'https://pixelwave.tech';
$email = 'D.Novak@pixewave.tech';
$available = true;

//adress
$postcode = 11000;
$city = 'Prague';
$country = 'Czech Republic';
$street = 'Vodičkova';
$dn = '791';
$rn = '41';

$adress = $postcode . ' ' . $city . ', ' . $country . ', ' . $city . ' ' . intdiv($postcode, 10000) . ', ' . $street . ' ' . $dn . '/' . $rn

?>

<!DOCTYPE html>
<head>
    <meta charset = 'utf-8'>
    <meta name = 'viewport' content="width=device-width, initial-scale=1.0" />
    <title>My first buisness card</title>
    <link rel = 'stylesheet' href = 'styles/<?php echo $styles; ?>'/>
</head>
<body>
    <div class = "title">
        <h1>My First Buisness Card in PHP</h1>
    </div>
    <div class = "front">
        <img class = 'icon' src = 'img/<?php echo $logo; ?>'>
        <div class = 'line1'></div>
        <div class = 'text1'>
            <span class = 'name'> <?php echo $name; ?> </span>
            <span class = 'lastname'> <?php echo $lastname; ?> </span> 
            <div class = 'age'> <?php echo $age; ?> y.o</div>
            <div class = 'position'><?php echo $position; ?></div>
        </div>
    </div>
    <div class = 'back'>
        <div class = 'back_header'>
            <img class = 'icon_small' src = 'img/<?php echo $logo; ?>'>
            <p class = 'company_name'><?php echo $company_name; ?></p>
        </div>
        <img class = 'qrcode' src = 'img/qrcode.svg'>
        
        <div class = 'line2'></div>
        <div class = 'contacts'>
            <div class = 'contact_div'>
                <img class = 'contact_icon' src = 'img/<?php echo $place_icon; ?>'>
                <p class = 'contact_text' style = 'margin-left:18px'><?php echo $adress; ?></p>
            </div>
            <div class = 'contact_div'>
                <img class = 'contact_icon' src = 'img/<?php echo $phone_icon; ?>'>
                <p class = 'contact_text'><?php echo $phone_number; ?></p>
            </div>
            <div class = 'contact_div'>
                <img class = 'contact_icon' src = 'img/<?php echo $web_icon; ?>'>
                <p class = 'contact_text'><?php echo $website; ?></p>
            </div>
            <div class = 'contact_div'>
                <img class = 'contact_icon' src = 'img/<?php echo $at_icon; ?>'>
                <p class = 'contact_text'><?php echo $email; ?></p>
            </div>
            <p class = 'contact_text'> <?php echo $available ? 'Now available for contracts' : 'Not available for contracts'; ?></p>
        </div>
    </div>

</body>
</html>