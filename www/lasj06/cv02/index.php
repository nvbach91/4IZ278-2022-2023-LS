<?php

require 'Person.php';
require 'utils.php';

$person1 = new Person(
    'img/logo.png',
    'Jiří Láska',
    'Student',
    'Vysoká škola ekonomická v Praze',
    'Štorkánova 2808/12',
    'Praha 5',
    '+420 607 076 066',
    'jirka@lasci.cz',
    'esotemp.vse.cz/lasj06/cv01',
    false,
    calculateAge('2000/12/12')
);

$person2 = new Person(
    'img/logo.png',
    'Pepa Novák',
    'Student',
    'Vysoká škola ekonomická v Praze',
    'Radlická 1851/3',
    'Praha 5',
    '+420 123 456 789',
    'pepik@novak.cz',
    'esotemp.vse.cz/novp00/cv01',
    true,
    calculateAge('2001/8/11')
);

$person3 = new Person(
    'img/logo.png',
    'Jarmila Farrney',
    'Učitelka',
    'Vysoká škola ekonomická v Praze',
    'Dostánská 28/8',
    'Praha 1',
    '+420 987654321',
    'farj00@vse.cz',
    'esotemp.vse.cz/novp00/cv01',
    false,
    calculateAge('1994/6/10')
);

$people = [$person1, $person2, $person3];
?>

<?php include 'head.php' ?>
<?php foreach($people as $person): ?>
    <div class="main">
        <div class="main-info">
            <img class="logo" src="<?php echo $person->logo; ?>" width="30" height="20" alt="VŠE logo">
            <p><?php echo $person->name ?></p>
            <p><?php echo $person->age ?></p>
            <p><?php echo $person->position ?></p>
            <p><?php echo $person->companyName ?></p>
        </div>
        <div class="address">
            <p><?php echo $person->cityName ?></p>
            <p><?php echo $person->address ?></p>
        </div>
        <div class="contact">
            <p><?php echo $person->mail ?></p>
            <p><?php echo $person->phone ?></p>
            <?php echo $person->webAddress ?>
            <p><?php
                if ($person->isLookingForWork == false) {
                    echo "Nehledám zaměstnání";
                } else {
                    echo "Hledám zaměstnání";
                }
            ?></p>
        </div>
    </div>
<?php endforeach ?>
<?php include 'foot.php' ?>
