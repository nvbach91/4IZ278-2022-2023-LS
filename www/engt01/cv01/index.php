<?php
$name = "Pepa Vonásek";
$date_of_birth = date_create("4/2/1989");
$age = date_diff($date_of_birth, date_create())->y;
$phone = "+420 123 456 789";
$email = "pepa@vonasek.biz";
$web = "https://vonasek.biz";
$pic = "https://e9g2x6t2.rocketcdn.me/wp-content/uploads/2022/06/linkedin-headshot-photography-examples-6-1.jpg";
$available = false;
$job = "Burger Flipper";
$company = "Voňavé burgery";
$street = "nám. W. Churchilla";
$num_d = "1938";
$num_o = "4";
$city = "Praha 3 - Žižkov";
$addr = $street . " " . $num_d . "/" . $num_o . ", " . $city;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business Card</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="bc">
    <img src="<?php echo $pic ?>" alt="My photo" width="200">
    <div id="info">
        <span><strong><?php echo $name ?></strong></span>
        <span><?php echo $job ?></span>
        <span><?php echo $age ?> years</span>
        <span><?php echo $phone ?></span>
        <span><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></span>
        <span><a href="<?php echo $web ?>"><?php echo $web ?></a></span>
        <span><?php echo $addr ?></span>
    </div>
</div>
</body>
</html>
