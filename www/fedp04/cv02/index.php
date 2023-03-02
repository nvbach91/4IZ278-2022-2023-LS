<?php

class Person {
    public function __construct(
    public $name,
    public $surname,
    public $adress,
    public $birthYear,
    public $number,
    public $position,
    public $firm_name,
    public $email,
    public $web,
    public $job,
    public $avatar)  {
    }
}



$name1 = 'Polina';
$surname1 = 'Fediaeva';
$birthYear1 = 2002;
$adress1 = 'Praha 4';
$number1 = '1234567';
$position1 = 'Director of the firm';
$firm_name1 = 'Best firm';
$email1 = 'zzefir.rum@mail.com';
$web1 = 'www.web.com';
$job1 = 'Available for job';
$avatar1 = 'pepeRound.png';


$name2 = 'Tyler';
$surname2 = 'Durden';
$birthYear2 = 1980;
$adress2 = 'Brno 1';
$number2 = '09786434';
$position2 = 'Founder of the Fight club';
$firm_name2 = 'Fight club';
$email2 = 'posta@gmail.com';
$web2 = 'www.hahahaa.com';
$job2 = 'Not available';
$avatar2 = 'tyler.webp';

$name3 = 'The';
$surname3 = 'Narrator';
$birthYear3 = 1970;
$adress3 = 'Olomouc 666';
$number3 = '45674567';
$position3 = 'Co-founder of the Fight club';
$firm_name3 = 'Fight club';
$email3 = 'email@gmail.com';
$web3 = 'www.heheeee.com';
$job3 = 'Super unavailable for job';
$avatar3 = 'narrator.jpg';




$person1 = new Person (
    $name1,
    $surname1,
    $birthYear1,
    $adress1,
    $number1,
    $position1,
    $firm_name1,
    $email1,
    $web1,
    $job1,
    $avatar1
);

$person2 = new Person (
    $name2,
    $surname2,
    $birthYear2,
    $adress2,
    $number2,
    $position2,
    $firm_name2,
    $email2,
    $web2,
    $job2,
    $avatar2
);

$person3 = new Person(
    $name3,
    $surname3,
    $birthYear3,
    $adress3,
    $number3,
    $position3,
    $firm_name3,
    $email3,
    $web3,
    $job3,
    $avatar3

);

$people =[$person1, $person2, $person3];
function calculateAge($birthYear) {
    $age = 2023 - $birthYear;
    return $age;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business_card</title>
    <link href='https://fonts.googleapis.com/css?family=Merienda' rel='stylesheet'>
    <link rel="stylesheet" href="style.css" />
</head>


<body>
    <?php foreach($people as $person) :?>
    <div class="business-card-container">

        <div class="business-card front">

            <div class="front-image"><img src="./<?php echo $person->avatar ?>"/></div>
            <div class="front-info">
                <h2 class="name"> <?php echo $person->name; ?> </h2>
                <h2 class="surname"> <?php echo $person->surname; ?> </h2>
                <p class="birthYear"> <?php echo $person->birthYear; ?> </p>
                <p class="firm_name"> <?php echo $person->firm_name; ?> </p>
                <p class="position"> <?php echo $person->position; ?> </p>
            </div>
        </div>

        <div class="business-card back">
            <p class="adress"> <?php echo $person->adress; ?> </p>
            <p class="number"> <?php echo $person->number; ?> </p>
            <p class="email"> <?php echo $person->email; ?> </p>
            <p class="web"> <?php echo $person->web; ?> </p>
            <p class="job"> <?php echo $person->job; ?> </p>
        </div>


    </div>
    <?php endforeach ?>
</body>


</html>