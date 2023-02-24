<?php
$avatar = "logo.png";
$name = "Mykhailo";
$surname = "Bubnov";
$age = 19;
$position = "Software Developer";
$firmName = "Sefira spol.";
$street = "A. Staška";
$streetNumber1 = '2027';
$streetNumber2 = '/77';
$city = "Praha 4";
$phone = "+420 777 777 777";
$email = "applemix00@gmail.com";
$web = "https://www.sefira.cz/";
$lookingForJob = false;
if ($lookingForJob) {
    $lookingForJob = "Available for contracts";
} else {
    $lookingForJob = "Not available for contracts";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" />
    <title>Document</title>
    <link rel="shortcut icon" type="image/x-icon" href="sefira-icon-32.png" />
</head>

<body>
    <h1>My business card</h1>
    <div class="bc-container">
        <div class="bc-front bc">
            <div class="bc-img-div">
                <img src=<?php echo $avatar ?> alt="avatar" />
            </div>
            <div class="bc-textbox">
                <div class="bc-name"><?php echo $name ?></div>
                <div class="bc-surname"><?php echo $surname ?></div>
                <div class="bc-position"><?php echo $position ?></div>
                <div class="bc-organisation"><?php echo $firmName ?></div>
            </div>
        </div>
        <div class="bc-back bc">
            <div class="bc-textbox back-name w-50">
                <div class="bc-name"><?php echo $name ?></div>
                <div class="bc-surname"><?php echo $surname ?></div>
                <div class="bc-position"><?php echo $position ?></div>
            </div>
            <div class="contacts w-50" class="bc-textbox">
                <div class="bc-address"> <?php echo $street . ' ' . $streetNumber1 . $streetNumber2 ?></div>
                <div class="bc-phone"> <?php echo $phone ?> </div>
                <div class="bc-email"> <?php echo $email ?> </div>
                <div class="bc-web"><a href=<?php echo $web ?>> <?php echo $web ?> </a></div>
                <div> <?php echo $lookingForJob ?> </div>
            </div>
        </div>
    </div>
</body>

</html>