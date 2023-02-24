<?php

require './Person.php';
require './utils.php';

$person1 = new Person(
    'Milena',
    'Chadimová',
    'Gulgurkovova',
    '13',
    '75245689',
    './portfolio_portrait.png',
    2000
);
$person2 = new Person(
    'Kuba',
    'Kubikula',
    'Příčná ulice',
    '22',
    '7464558778',
    'https://cdn.pixabay.com/photo/2016/12/13/16/17/dancer-1904467_1280.png',
    2004
);
$person3 = new Person(
    'Andrej',
    'Vepřinec',
    'Náměstí RapPubliky',
    '25/3f',
    '753951456',
    'https://cdn.pixabay.com/photo/2016/11/01/21/11/avatar-1789663_1280.png',
    1995
);

$people = [$person1, $person2, $person3];

?>

<?php include './header.php' ?>
<?php foreach ($people as $person) : ?>
    <div class="business-card">
        <div class="name">
            <?php echo $person->getFullName(); ?>
        </div>
        <br>
        <div class="age">
            <?php echo $person->getAge() . " let"; ?>
        </div>
        <br>
        <div class="birth">
            <?php echo $person->birthYear; ?>
        </div>
        <br>
        <div class="adress">
            <?php echo $person->getFullAdress(); ?>
        </div>
        <br>
        <div class="phone-number">
            <?php echo $person->phone; ?>
        </div>
        <br>
        <div class="portrait">
            <img src="<?php echo $person->avatar; ?>" alt="my face">
        </div>
        <span class="dot"></span>
    </div>
<?php endforeach; ?>
<?php include './footer.php' ?>