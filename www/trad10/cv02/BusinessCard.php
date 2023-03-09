<?php

require_once './Person.php';

$people = [
    new Person(
        'Daniel',
        'Tran',
        'Software Developer',
        'Verisoft',
        'verisoft-logo.webp',
        '+420 777 777 777',
        'daniel.tran@verisoft.cz',
        'verisoft.cz',
        false,
        'Radlická',
        '42',
        '121',
        'Prague',
        99999999,
        'CZK'
    ),
    new Person(
        'Petr',
        'Mastný',
        'Manager',
        'Verisoft',
        'verisoft-logo.webp',
        '+420 666 666 666',
        'petr.mastny@verisoft.cz',
        'verisoft.cz',
        false,
        'Radlická',
        '42',
        '121',
        'Prague',
        88888888,
        'CZK'
    ),
    new Person(
        'Pavel',
        'Nový',
        'PHP Developer',
        'Verisoft',
        'verisoft-logo.webp',
        '+420 555 555 555',
        'pavel.novy@verisoft.cz',
        'verisoft.cz',
        true,
        'Radlická',
        '42',
        '121',
        'Prague',
        88888888,
        'CZK'
    )];
?>

<h1 class="text-center">My Business Cards in PHP</h1>
<?php foreach($people as $person): ?>
    <div class="row">
        <div class="business-card bc-front">
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
        <div class="business-card bc-back">
            <div class="col-sm-6">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title; ?></div>
            </div>
            <div class="col-sm-6 contacts">
                <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress(); ?></div>
                <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
                <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
                <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
                <div class="bc-available"><?php echo $person->getAvailability(); ?></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>