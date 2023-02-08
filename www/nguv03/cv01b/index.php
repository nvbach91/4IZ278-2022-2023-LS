<?php

// tohle je jednoradkovz komentar
$name = 'Homer Simpson';

/**
 * this is a multiline comment
 */
$position = 'Nuclear Plant Manager';
$address = 'Springfield 123';
$email = 'homer@simpson.cz';
$phone = '+420 123 456 789';
$website = 'https://abc.com';


$isDead = true; // false

$birthYear = 1959;
$amountOfMoney = 100959.123;

//         0        1         2
$fruits = ['Melon', 'Orange', 'Kiwi', 'Blue berry'];
// echo $fruits[1];

for($i = 0; $i < count($fruits); $i++) {
    echo $fruits[$i];
}

$person1 = [
    'name' => 'Martha',
    'surname' => 'Kent',
    'age' => 50,
];

echo $person1['name'];





$str1 = 'Some word';
$str2 = 'some other words';

$str3 = $str1 . ' ' . $str2;

echo $str3;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./main.css" rel="stylesheet">
</head>

<body>
    <h1>This is my business card</h1>
    <div class="business-card">
        <div class="bc-name">
            <?php echo $name; ?>
        </div>
        <div class="bc-position">
            <?php echo $position; ?>
        </div>
        <div class="bc-address">
            <?php echo $address; ?>
        </div>
        <div class="bc-email">
            <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
        </div>
        <div class="bc-phone">
            <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
        </div>
        <div class="bc-website">
            <a href="<?php echo $website; ?>"><?php echo $website; ?></a>
        </div>
    </div>
</body>

</html>