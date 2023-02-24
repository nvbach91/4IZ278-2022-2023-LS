<?php
// string
// adqwa
$name = 'Barrack Obama Blablablabl'; 

/*
abc je proste promenna ktera neco dela
*/

// int (number)
$year = 1992;

// float/double
$balance = 123.456;

// $sum = $year + $balance;

// boolean
$isMarried = false; // nebo false
// $isMarried = false; 

$animals = ['dog', 'cat', 'elephant'];

// var_dump($animals);

$nothing = NULL;

$stringNumber1 = '123';
$stringNumber2 = 'abc';

$stringNumber1 .= $stringNumber2;

$intNumber = intval($stringNumber1);


if ($isMarried) {
    echo 'Yes, I am married';
} elseif ($someOtherVariable) {
    echo 'second case when someOtherVariable is true';
} else {
    echo 'other cases';
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
    <?php echo $stringNumber1; ?>
    <br>
    <?php echo $intNumber; ?>
    <br>
    <?php echo $nothing; ?>
    <br>
    <?php echo $name; ?>
    <br>
    <?php echo $year; ?>
    <br>
    <?php echo $balance; ?>
    <br>
    <?php echo $isMarried; ?>
</body>
</html>