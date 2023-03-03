<?php

//PascalCase
require './Person.php';

    $person1 = new Person(
        'Miles',
        'Edgeworth',
        'Japan',
        'Acting defense attorney',
        'https://i.imgflip.com/55uwlv.png?a465648',
        1993
    );
    $person2 = new Person(
        'Phoenix',
        'Wright',
        'Japan',
        'Pianist (ex defense attorney)',
        'https://i.kym-cdn.com/photos/images/original/000/233/596/722.png',
        1992
    );
    $person3 = new Person(
        ' 小島',
        '秀夫',
        '東京',
        'Gamedesigner',
        'https://i.kym-cdn.com/photos/images/facebook/000/912/361/d33.jpg',
        1963
    );

    $people =[$person1, $person2, $person3];

    //var_dump($person1);
    //echo $person1->name;

?>
<!DOCTYPE html>
<?php include './header.php' ?>

<body>
    <main class="container">
        <?php foreach($people as $person): ?>
        <div class="business-card bc-front">
                <div class="logo" style="background-image: url(<?php echo $person->avatar; ?>)"></div>
            <div class="column">
                <div class="bc-name"><?php echo $person->getFullName(); ?></div>
                <div class="bc-address"><?php echo $person->address; ?></div>
                <div class="bc-occipation"><?php echo $person->occupation; ?></div>
                
                <div class="bc-age">Age: <?php echo $person->calculateAge(); ?></div>
            </div>
        </div>
        <?php endforeach ?>
    </main>
</body>

</html>