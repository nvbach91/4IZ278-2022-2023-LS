<?php

$firstName = 'James';
$lastName = 'Nobel';
$jobTitle = 'Full-Stack Developer';
$dateOfBirth = '21-10-1989';
$streetName = 'Bartolomějská';
$streetNumber = '113';
$orNumber = '/15';
$city = 'Praha 1';
$website = 'https://www.nobelprize.org/';
$isLookingForJob = true;
$phone = '+420 604 156 123';
$email = 'jnobel@gmail.com';
$companyName = 'Nobel s.r.o.';
$today = date("2023-02-23");
$age = date_diff(date_create($dateOfBirth), date_create($today));

$fullName = $firstName . ' ' . $lastName;

$fullAddress = $streetName . ' ' . $streetNumber . $orNumber . ', ' . $city;

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/styles.css">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bum</title>
</head>

<body>
    <div class="business-card-front">
        <div class="text-wrapper">
            <div class="bc-name"><?php echo $fullName ?></div>
            <div class="bc-title"><?php echo $jobTitle ?></div>
            <div class="bc-company"><?php echo $companyName ?></div>
        </div>
        <div class="image-wrapper">
            <image class="bc-image" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Wikimedia-logo.png" alt="Avatar">
        </div>

    </div>

    <div class="business-card-back">
        <div class="margin-left">
            <div class="bc-address"><?php echo $fullAddress ?></div>
            <div class="bc-phone"><?php echo $phone ?></div>
            <div class="bc-age"><?php echo 'Age: ' . $age->format('%y') ?></div>
            <div class="bc-email"><?php echo $email ?></div>
            <div class="bc-website"><?php echo $website ?></div>
            <div class="bc-contracts"><?php if ($isLookingForJob) {
                                            echo 'OPEN FOR CONTRACTS';
                                        } ?></div>

        </div>

    </div>
</body>

</html>