<?php
require './Person.php';
$people =[];
array_push($people, new Person(
    './img/widepeepoHappy.png',
    'Filip',
    'Ježek',
    'CEO',
    'Dreamtrender',
    '+421 902 384 569',
    'jezek@dreamtrender.com',
    'www.dreamtrender.com',
    false,
    'Mládežnícká',
    406,
    90880,
    'Sekule',
    1217412.420,
    'CZK',
    '2001-10-03'
));

array_push($people, new Person(
    './img/pepega.png',
    'Dávid',
    'Kubinec',
    'CEO',
    'Dreamtrender',
    '+421 902 384 568',
    'kubinec@dreamtrender.com',
    'www.dreamtrender.com',
    true,
    'Kubincova',
    406,
    90880,
    'Martin',
    124412.420,
    'CZK',
    '2000-08-03'
));

array_push($people, new Person(
    './img/widepeepoHappy.png',
    'Martin',
    'Ježek',
    'Secretary',
    'Dreamtrender',
    '+421 902 384 567',
    'secretary@dreamtrender.com',
    'www.dreamtrender.com',
    true,
    'Mládežnícká',
    406,
    90880,
    'Sekule',
    1247412.420,
    'CZK',
    '1999-10-03'
));
?>
<h1 class="text-center">My Business Card in PHP</h1>
<?php foreach($people as $person):?>
        <div class="business-card bc-front row">
            <div class="col-sm-4">
                <div class="logo" style="background-image: url(<?php echo $person->avatar; ?>)"></div>
            </div>
            <div class="col-sm-8">
                
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title; ?></div>
                <div class="bc-company"><?php echo $person->company; ?></div>
               </div>
        </div>
        <div class="business-card bc-back row">
            <div class="col-sm-6">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title;?></div>
            </div>
            <div class="col-sm-6 contacts">
                <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress(); ?></div>

                <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
                <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
                <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
                <div class="age"><i class="fa fa-calendar"></i> <?php echo $person->birthdate; echo " (".$person->getAge().")"; ?></div>
                <div class="bc-available"><?php echo $person->available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
            </div>
        </div>
        <?php endforeach;?>