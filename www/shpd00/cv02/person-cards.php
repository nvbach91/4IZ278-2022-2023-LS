<?php
require 'person.php';
    
$persons = [
    new Person('jedi-logo.svg','Anakin','Skywalker','Lead Developer / Architect','First Order Jedi Council','+420 777 888 999','skywalker@jedi-council.com','www.jedi-council.com',false,'Temple of Eedit',42,121,'Coruscant',19)
    ,new Person('croc.svg','Nile','Crocodile',' Largest freshwater predator','Africa','+254 722204859','stealthybastard@nile.com','crocworld.co.za',true,'Scottburgh ',0,0 ,'South Africa',1956)
    ,new Person('galaxy.svg','Sagittarius ','A*','Supermassive black hole/Galactic Center','Milky Way','+999 999 999 999','galactic.center@milky-way.com','milky-way.com',false,'Milky Way',0,0,'Universe',-0)
];
?>

<main class="container">
<?php  foreach($persons as $person): ?>
    <h1 class="text-center">My Business Card in PHP</h1>
    <div class="business-card bc-front row">
        <div class="col-sm-4">
            <div class="logo" style="background-image: url(./img/<?php echo $person->avatar; ?>)"></div>
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
            <div class="bc-title"><?php echo $person->title ?></div>
        </div>
        <div class="col-sm-6 contacts">
            <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAdress(); ?></div>
            <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
            <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
            <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
            <div class="bc-available"><?php echo $person->available ? 'Now available for contracts' : 'Not available for contracts'; ?></div>
        </div>
    </div>
<?php  endforeach; ?>
</main>