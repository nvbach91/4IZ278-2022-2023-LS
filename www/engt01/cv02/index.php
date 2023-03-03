<?php
require "Person.php";

$person = new Person("Pepa", "Vonásek", "4/2/1989", "+420 123 456 789", "pepa@vonasek.biz", "https://vonasek.biz",
    "https://e9g2x6t2.rocketcdn.me/wp-content/uploads/2022/06/linkedin-headshot-photography-examples-6-1.jpg",
    false, "Burger Flipper", "Voňavé burgery", "nám. W. Churchilla", 1938, 4, "Praha 3 - Žižkov");
$personToo = new Person("Monika", "Nová", "6/9/1991", "+420 987 654 321", "monika@nova.eu", "https://nova.eu",
    "https://img.fixthephoto.com/blog/images/gallery/news_preview_mob_image__preview_11368.png",
    true, "Assistant", "Voňavé burgery", "nám. W. Churchilla", 1938, 4, "Praha 3 - Žižkov");
$personTree = new Person("Petr", "Votava", "9/9/1999", "+420 777 777 777", "petr@votava.io", "https://votava.io",
    "https://static.photocdn.pt/images/articles/2019/08/07/images/articles/2019/07/31/linkedin_profile_picture_tips-1.webp",
    true, "Coffee Maker", "Voňavé burgery", "nám. W. Churchilla", 1938, 4, "Praha 3 - Žižkov");
$people = [$person, $personToo, $personTree];

require "header.php";

foreach ($people as $person): ?>
    <div class="bc">
        <img src="<?php echo $person->pic ?>" alt="My photo" width="200">
        <div class="info">
            <span><strong><?php echo $person->getFullname() ?></strong></span>
            <span><?php echo $person->job ?></span>
            <span><?php echo $person->company ?></span>
            <span><?php echo $person->getAge() ?> years</span>
            <span><?php echo $person->phone ?></span>
            <span><a href="mailto:<?php echo $person->email ?>"><?php echo $person->email ?></a></span>
            <span><a href="<?php echo $person->web ?>"><?php echo $person->web ?></a></span>
            <span><?php echo $person->getAddress() ?></span>
        </div>
    </div>
<?php
endforeach;
require "footer.php"
?>

