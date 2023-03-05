<?php
    require "Person.php";


    $name = "David";
    $surname = "Mikula";
    $birthYear = 2002;
    $logo = "https://ysdmikula.github.io/me/aboutMe/logo.jpg";
    $city = "Praha";
    $status = "student";
    $phone = 33333333;
    $backPic = "potato.png";


    function calcAge($birthYear){
        return 2023 - $birthYear;
    }




    $me = new Person("dave", "mikula", "89879546321", "2002", "Prague");
    $person2 = new Person("yo", "lo", "11111111", "0000", "????");

    $people = [$me, $person2]
?>


<?php include "head.php"?>
<body>
    <div id="front" class="card-side">
        <img src="<?php echo $logo;?>" alt="profPic">
        <div>
            <h1 id="name"><?php echo $name?></h1>
            <h1 id="surname"><?php echo $surname ?></h1>
            <div id="age" class="info"><span class="material-symbols-outlined">cake</span><span><?php echo calcAge($birthYear) ?></span></div>
            <div id="city" class="info"><span class="material-symbols-outlined">home</span><span><?php echo $city ?></span></div>
            <div id="phone" class="info"><span><?php echo $phone ?></span></div>
        </div>

    </div>
    <div id="back" class="card-side">
        <img src="<?php echo $backPic ?>" alt="">
        <div>github.com/ysdmikula</div>
    </div>

    <?php foreach($people as $person):?>
        <div id="front" class="card-side">
        <img src="<?php echo $logo;?>" alt="profPic">
        <div>
            <h1 id="name"><?php echo $person->name?></h1>
            <h1 id="surname"><?php echo $person->surname ?></h1>
            <div id="age" class="info"><span class="material-symbols-outlined">cake</span><span><?php echo calcAge($person->birthYear) ?></span></div>
            <div id="city" class="info"><span class="material-symbols-outlined">home</span><span><?php echo $person->city ?></span></div>
            <div id="phone" class="info"><span><?php echo $person->phone ?></span></div>
        </div>

    </div>
    <div id="back" class="card-side">
        <img src="<?php echo $backPic ?>" alt="">
        <div>github.com/ysdmikula</div>
    </div>
    <?php endforeach?>
</body>
</html>
