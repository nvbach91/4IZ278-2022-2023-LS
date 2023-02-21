<?php
$name = "Miluška Chadimová"; //string
$age = 100;/*víceřádkový komentář */
$balance = 123.55;
$isMarried = true;
$animals = ["dog", "cat", "horse", "parrot"];
$nothing = NULL;

//podívat se do obsahu proměnné!!
var_dump($animals);

//Přetypování
$stringNumber = "123";
$intNumber = intval($stringNumber);

//podmínky
if ($isMarried) {
    echo "I am married.";
} elseif (!$isMarried && $age > 20) {
    echo "over 20 and not married";
} else {
    echo "not married";
};

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
    <?php echo $animals[0]; ?>
    <br>
    <?php echo $name; ?>
    <br>
    <?php echo $age; ?>
    <br>
    <?php echo $balance; ?>
    <br>
    <?php echo $isMarried; ?>
    <br>
    <?php echo $nothing; ?>
    <br>
    <?= $intNumber; ?><!--zkrácený zápis echo-->
</body>

</html>