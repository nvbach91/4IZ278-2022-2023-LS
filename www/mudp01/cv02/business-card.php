<?php
require 'classes/Person.php';

$person1 = new Person('John Doe', 'unemployed :(', '+420', '123 456 789', 'Praha 1', '110 00', 'johndoe@example.com', 'https://static.vecteezy.com/system/resources/previews/010/879/656/original/avatar-man-person-face-icon-illustration-head-character-cartoon-human-portrait-profile-avatar-user-man-isolated-white-adult-silhouette-human-face-avatar-man-icon-character-headshot-element-vector.jpg', 2000);
$person2 = new Person('Anna Doe', 'something CEO :)', '+420', '987 654 321', 'Praha 1', '110 00', 'annadoe@example.com', 'https://static.vecteezy.com/system/resources/previews/004/773/704/original/a-girl-s-face-with-a-beautiful-smile-a-female-avatar-for-a-website-and-social-network-vector.jpg', 1999);
$person3 = new Person('Ciril Doe', 'something else CFO', '+420', '654 987 321', 'Praha 5', '117 00', 'cirildoe@example.com', 'https://thumbs.dreamstime.com/b/portrait-asian-man-young-boy-wearing-traditional-clothes-chinese-male-avatar-icon-portrait-asian-man-young-boy-wearing-107780546.jpg', 1998);

$persons = [$person1, $person2, $person3];
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php' ?>

<body>
    <?php foreach ($persons as $person) : ?>
        <div class="bc">
            <div class="bc-side1">
                <p class="bc-side1-name"><?php echo $person->name ?></p>
                <p class="bc-side1-profession"><?php echo $person->profession . ' ' . '(' . $person->age . ' y.o.)' ?></p>
                <div class="square"></div>
            </div>

            <div class="bc-side2">
                <div class="cdge">
                    <div class="bc-side2-content">
                        <img class="contact-img" src="https://img.freepik.com/premium-vector/phone-call-icon-isolated-white-background-telephone-symbol-vector-illustration_548264-469.jpg?w=2000" alt="phone-image">
                        <p class="contact-content"><?php echo $person->getFullPhone() ?></p>
                        <img class="contact-img" src="https://t3.ftcdn.net/jpg/02/36/10/52/360_F_236105214_BAZwfP797jng1TdjSuEaFWpiz4HyXvzZ.jpg" alt="email-image">
                        <p class="contact-content"><?php echo $person->email ?></p>
                        <img class="contact-img" src="https://static.vecteezy.com/system/resources/thumbnails/014/989/575/small/pin-line-icon-in-black-on-a-white-background-it-s-perfect-for-locations-signs-and-navigational-concepts-vector.jpg" alt="adress-image">
                        <p class="contact-content"><?php echo $person->getFullAdress() ?></p>
                    </div>
                    <div class="avatar">
                        <img class="avatar-img" src="<?php echo $person->avatarAdress ?>" alt="avatar">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</body>

</html>