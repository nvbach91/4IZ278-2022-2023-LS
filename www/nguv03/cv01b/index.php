<?php
// string
$name = 'Michelle Obama';

// integer (number)
$age = '50';

// float (double)
$balance = 123.20;

// Boolean
$isMarried = true; // false;

// array / pole
$animals = ['lion', 'tiger', 'elephant'];

// null
$nothing = NULL;

// $ageString = (string) $age;
$ageInt = intval($age);

// var_dump($ageInt);
// var_dump($isMarried);
// var_dump($name);

$street = 'Adresova';
$number = 122;

// $address = $street . ' ' . $number;
// $address = "$street $number";
$address = "$street $number";

if ($isMarried) {
    echo 'Yes, I am married';
} else {
    echo 'No I am not married';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Name: <?php echo $name; ?></h1>
    <h2>Age: <?php echo $ageInt; ?></h2>
    <p>Bank balance: <?php echo $balance; ?></p>
    <p><?php echo $isMarried; ?></p>
    <p><?php echo $nothing; ?></p>
    <p><?php echo $address; ?></p>
</body>
</html>