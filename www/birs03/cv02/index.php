<?php

require 'Person.php';

$person1 = new Person(
    'Michael',
    'Jordan',
    'https://i.bleacherreport.net/images/team_logos/328x328/chicago_bulls.png?canvas=492,328',
    '+421 955 456 983',
    'Brno 23',
    '1963-2-17'
);

$person2 = new Person(
    'Lebron',
    'James',
    'https://1000logos.net/wp-content/uploads/2021/04/Miami-Heat-logo.png',
    '+420 907 842 002',
    'Kysuce 06',
    '1984-12-30'
);

$person3 = new Person(
    'Kobe',
    'Bryant',
    'https://www.freepnglogos.com/uploads/lakers-logo-png/logo-lakers-with-blue-caption-png-0.png',
    '+421 918 345 223',
    'Lemesany 24',
    '1978-8-23'
);

$people = [$person1, $person2, $person3];

?>
<?php include('head.php'); ?>
<div class='title'>My business card in PHP</div>
    <?php foreach ($people as $person): ?>
        <div class='card front'>
            <div class='bc-avatar'>
                <img width='100' src='<?php echo $person->avatar; ?>' alt='avatar'>
            </div>
            <div class='bc-name'>
                <?php echo $person->getFullName(); ?>
            </div>
            <div class='bc-phone'>
                <?php echo $person->phone; ?>
            </div>
            <div class='bc-address'>
                <?php echo $person->address; ?>
            </div>
            <div class='bc-age'>
                <?php echo $person->getAge() . ' years old'; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php include('foot.php'); ?>