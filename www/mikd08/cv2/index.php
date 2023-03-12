<?php
    require "Person.php";

    $backPic = "potato.png";

    $me = new Person("dave", "mikula", "89879546321", "2002", "Prague", "https://ysdmikula.github.io/me/aboutMe/logo.jpg");
    $person2 = new Person("yo", "lo", "11111111", "1999", "????", "catPorcelain.png");
    $person3 = new Person("fizz", "fish", "88888888", "1000", "bilgewater", "https://ysdmikula.github.io/me/aboutMe/logo.jpg");

    $people = [$me, $person2, $person3]
?>


<?php include "head.php"?>
<?php include "generateCards.php"?>
<?php include "footer.php"?>