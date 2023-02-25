<?php
$name = 'Polina';
$surname = 'Fediaeva';
$year = '04.08.2002';
$adress = 'Praha 4';
$number = '1234567';
$position = 'Director of the firm';
$firm_name = 'Best firm';
$email = 'zzefir.rum@mail.com';
$web = 'www.web.com';
$job = 'Available for job';


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
    <div class="business-card-container">

        <div class="business-card front">

            <div class="front-image"><img src=<?php echo "./pepeRound.png" ?>></div>
            <div class="front-info">
                <h2 class="name"> <?php echo $name; ?> </h2>
                <h2 class="surname"> <?php echo $surname; ?> </h2>
                <p class="year"> <?php echo $year; ?> </p>
                <p class="firm_name"> <?php echo $firm_name; ?> </p>
                <p class="position"> <?php echo $position; ?> </p>
            </div>
        </div>

        <div class="business-card back">
            <p class="adress"> <?php echo $adress; ?> </p>
            <p class="number"> <?php echo $number; ?> </p>
            <p class="email"> <?php echo $email; ?> </p>
            <p class="web"> <?php echo $web; ?> </p>
            <p class="job"> <?php echo $job; ?> </p>
        </div>


    </div>

</body>


</html>