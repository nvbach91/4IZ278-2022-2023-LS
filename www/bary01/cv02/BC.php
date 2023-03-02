<?php
require './Person.php';

$people = [];

array_push($people, new Person(
    'img/yana.png',
    'Yana Bareika',
    'personal fitness trener',
    false,
    ' +420770653337',
    ' yana@gmail.com',
    ' https://www.formfactory.cz/',
    ' Václavské nám.',
    1323,
    22,
    'Prague'
));

array_push($people, new Person(
    'img/gym.png',
    'Jakub Luchava',
    'group fitness trener',
    true,
    ' +420727802906',
    ' luchava.jakub@gmail.com',
    ' https://www.formfactory.cz/',
    ' Vršovická',
    1525,
    1,
    'Prague'
));

array_push($people, new Person(
    'http://cdn.onlinewebfonts.com/svg/img_546362.png',
    'David Mrazek',
    'personal fitness trener',
    true,
    ' +420776186770',
    ' mrazekmd.92@gmail.com',
    ' https://www.formfactory.cz/',
    ' Radlická',
    3525,
    117,
    'Prague'
));
?>

<h1 class="text-center">My Business Card in PHP OOP</h1>
<?php foreach($people as $person): ?>
    <div class="row">
    <div class="business-card front">
        <div class="col-sm-4">
            <div class="logo"style="background-image: url(<?php echo $person -> avatar; ?>)"></div>
        </div>
        <div class="info">
            <div class="bc-name"> <?php echo $person -> name; ?></div>
            <div class="bc-job"><?php echo $person -> job; ?></div>
        </div>
    </div>
        <div class="business-card back">
            <div class="col-sm-6">
                <div class="bc-name"><?php echo $person -> name; ?></div>
                <div class="bc-job"><?php echo $person -> job ?></div>
            </div>
            <div class="contacts">
                <div class="bc-address"> <?php echo "<img src='img/loc.svg'>";?><?php echo $person -> getAddress(); ?></div>
                <div class"bc-phone"><?php echo "<img src='img/phone.svg'>";?> <?php echo $person -> phone; ?></div>
                <div class="bc-email"><?php echo "<img src='img/mail.svg''>";?><?php echo $person -> mail; ?></div>
                <div class="bc-website"><?php echo "<img src='img/web.svg'>";?> <?php echo $person -> website; ?></div>
                <div class="bc-available"><?php echo $person ->getAvailability(); ?></div>

            </div>
        </div>
    </div>
    <?php endforeach; ?>