<?php
$fruits = ['melon','orange','grape','blueberry'];
$animals = ['cat','dog','elephant'];
$films= ['The Green Mile','Harry Potter', 'Fantastic beasts'];
$organisations = ['Google','IBM','Apple','Samsung'];

$name = 'Avdeeva Nadezhda';
$birthDate = "07/28/2001";
$birthYear = 2001;
$occupation = 'student';
$university = 'VŠE';
$street = ' nám. Winstona Churchilla';
$cPopisne = '1938';
$cOrientacni = '4';
$city = 'Prague 3';
$phone = '+420 866 367 277';
$email = 'avdn00@vse.cz';
$webPage = 'www.webpage-avdn00.com';
$available = true;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Arrays</title>
  </head>
 
  <body>
    <ul class="fruits">
        <?php foreach($fruits as $fruit): ?>
            <li><?php echo $fruit ?></li>
            <?php endforeach; ?>
    </ul>

    <ul class="animals">
        <?php foreach($animals as $animal): ?>
            <li><?php echo $animal?></li>
            <?php endforeach?>
    </ul>

    <ul class="films">
        <?php foreach($films as $film): ?>
            <li><?php echo $film?></li>
            <?php endforeach?>
    </ul>

    <ul class="organisations">
        <?php foreach($organisations as $organisation): ?>
            <li><?php echo $organisation?></li>
            <?php endforeach?>
    </ul>
  </body>
</html>