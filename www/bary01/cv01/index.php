<?php
$avatar = 'yana.png';
$name = 'Yana Bareika';
$adress= ' Prague 3';
$phone = ' +420778653337';
$mail = ' jana.boreyko@gmail.com';
$job = 'Personal fitness trener';
$website = ' http://www.google.com/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Cviceni 1</title>
</head>

<body>
<main class="container">
    <h1 class="text-center">My Business Card in PHP</h1>
    <div class="business-card front">
        <div class="col-sm-4">
            <div class="logo"style="background-image: url(<?php echo $avatar; ?>)"></div>
        </div>
        <div class="info">
            <div class="bc-name"> <?php echo $name; ?></div>
            <div class="bc-job"><?php echo $job; ?></div>
        </div>
    </div>
        <div class="business-card back">
            <div class="col-sm-6">
                <div class="bc-name"><?php echo $name; ?></div>
                <div class="bc-job"><?php echo $job ?></div>
            </div>
            <div class="contacts">
                <div class="bc-address"> <?php echo "<img src='loc.svg'>";?><?php echo $adress; ?></div>
                <div class="bc-phone"><?php echo "<img src='phone.svg'>";?> <?php echo $phone; ?></div>
                <div class="bc-email"><?php echo "<img src='mail.svg''>";?><?php echo $mail; ?></div>
                <div class="bc-website"><?php echo "<img src='web.svg'>";?> <?php echo $website; ?></div>
            </div>
        </div>
</main>

</body>
</html>