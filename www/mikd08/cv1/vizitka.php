<?php
    $name = "David";
    $surname = "Mikula";
    $age = 20;
    $logo = "https://ysdmikula.github.io/me/aboutMe/logo.jpg";
    $city = "Praha";
    $status = "student";
    $backPic = "potato.png";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="vizitka.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    <div id="front" class="card-side">
        <img src=<?php echo $logo;?> alt="profPic">
        <div>
            <h1 id="name"><?php echo $name?></h1>
            <h1 id="surname"><?php echo $surname ?></h1>
            <div id="age" class="info"><span class="material-symbols-outlined">cake</span><span><?php echo $age ?></span></div>
            <div id="city" class="info"><span class="material-symbols-outlined">home</span><span><?php echo $city ?></span></div>
        </div>
        
    </div>
    <div id="back" class="card-side">
        <img src=<?php echo $backPic ?> alt="">
        <div>github.com/ysdmikula</div>
    </div>
</body>
</html>