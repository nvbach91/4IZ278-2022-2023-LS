<?php
$name = 'John Doe';
$profession = 'unemployed :(';
$pronePrefix = '+420';
$phone = '123 456 789';
$adress = 'Praha 1';
$psc = '110 00';
$email = 'johndoe@example.com';
$avatarAdress = 'https://static.vecteezy.com/system/resources/previews/010/879/656/original/avatar-man-person-face-icon-illustration-head-character-cartoon-human-portrait-profile-avatar-user-man-isolated-white-adult-silhouette-human-face-avatar-man-icon-character-headshot-element-vector.jpg';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Labrada">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="bc">
        <div class="bc-side1">
            <p class="bc-side1-name"><?php echo $name ?></p>
            <p class="bc-side1-profession"><?php echo $profession ?></p>
            <div class="square"></div>
        </div>

        <div class="bc-side2">
            <div class="cdge">
                <div class="bc-side2-content">
                    <img class="contact-img" src="https://img.freepik.com/premium-vector/phone-call-icon-isolated-white-background-telephone-symbol-vector-illustration_548264-469.jpg?w=2000" alt="phone-image">
                    <p class="contact-content"><?php echo $pronePrefix . ' ' . $phone ?></p>
                    <img class="contact-img" src="https://t3.ftcdn.net/jpg/02/36/10/52/360_F_236105214_BAZwfP797jng1TdjSuEaFWpiz4HyXvzZ.jpg" alt="email-image">
                    <p class="contact-content"><?php echo $email ?></p>
                    <img class="contact-img" src="https://static.vecteezy.com/system/resources/thumbnails/014/989/575/small/pin-line-icon-in-black-on-a-white-background-it-s-perfect-for-locations-signs-and-navigational-concepts-vector.jpg" alt="adress-image">
                    <p class="contact-content"><?php echo $adress . ', ' . $psc ?></p>
                </div>
                <div class="avatar">
                    <img class="avatar-img" src="<?php echo $avatarAdress ?>" alt="avatar">
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>