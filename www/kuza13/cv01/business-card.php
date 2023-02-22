<?php
$name = "Andrei Kuznetsov";
$age = '19 y.o.';
$adress = "Prague, Lumirova 29, 12800";
$phone = "+420705991337";
$logo = 'pok-choi.png';
$title = "Chief Executive Officer";
$company = "Red Cabbage S.R.O";
$email = 'smitandrei14@gmail.com';
$website = 'www.red-cabbage-sro.com';
$isWorking = false;
?>
<!DOCTYPE html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compitable" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Business Card in PHP</title>
    <link rel='stylesheet' href='styles/style.css' />
</head>

<body>
    <h1 class="centeredText">My PHP Business Card</h1>
    <div class="container">
        <div class="bc-front">
            <div class="icon">
                <img class="icon" src="img/pok-choi.png" alt="Pok Choi">
            </div>
            <div class="contacts">
                <div class="bc-name"><?php echo $name; ?> </div>
                <div class="bc-age"><?php echo $age; ?> </div>
                <div class="bc-title"><?php echo $title; ?></div>
                <div class="bc-company"><?php echo $company; ?></div>
            </div>

        </div>
        <div class="bc-back">
            <div class='header'>
                <div class='small-icon'>
                    <img class='bc-small-icon' src='img/<?php echo $logo; ?>' alt='Pok Choi'>
                </div>
                <div class='back-title'><?php echo $company ?></div>
                <div class='line'></div>
            </div>
            <div class='contacts-back'>
                <div class="bc-phone"><?php echo $phone; ?> </div>
                <div class="bc-adress"><?php echo $adress; ?> </div>
                <div class='bc-email'><?php echo $email ?></div>
                <div class='bc-website'><?php echo $website ?></div>
            </div>
            <div class='bc-isWorking'><?php if ($isWorking) {
                                            echo '<p style="color:lightgreen">' . 'Available for contact' . '</p>';
                                        } else {
                                            echo '<p style="color:red">' . 'Not available for contact' . '</p>';
                                        } ?></div>


        </div>
    </div>
</body>