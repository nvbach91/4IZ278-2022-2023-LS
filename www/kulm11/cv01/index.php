<?php
    $firstName = "Michal";
    $lastName = "Kulvejt";
    $phone = "777 666 555";
    $job = "Student VŠE";
    $birthYear = 2000;
    $age = 2023-$birthYear;
    $street = "Ulicová";
    $number = "666";
    $city = "Město nad Řekou";
    $zipCode = "123 45";
    $imageSrc = "assets/img/avatar.gif";
    $email = "michal.kulvejt@domain.com";
    $webAdress = "michalkulvejt.com";
    $lookingForJob = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class= "business-card">
        <div class="bc-name"><?php echo "$firstName $lastName ($age)"; ?></div>
        <div class="bc-job"><?php echo $job; ?></div>
        <div class="bc-web"><a href="http://<?php echo $webAdress; ?>"><?php echo $webAdress; ?></a></div>
        <div class="bc-avatar"><img width = "150" src="<?php echo $imageSrc ?>"></div>
    </div>
    <div class= "business-card" id="back">
        <div class="desc">ADRESS</div>
        <div class="bc-adress"><?php echo "$firstName $lastName"; ?></div>
        <div class="bc-adress"><?php echo "$street $number"; ?></div>
        <div class="bc-adress"><?php echo "$zipCode $city"; ?></div>
        <div class="desc">PHONE</div>
        <div class="bc-phone"><?php echo "$phone"; ?></div>
        <div class="desc">E-MAIL</div>
        <div class="bc-email"><?php echo "E-mail: $email"; ?></div>
    </div>
</body>
</html>