<?php
$logo = 'pok-choi.png';
$title = "Chief Executive Officer";
$company = "Red Cabbage S.R.O";
$website = 'www.red-cabbage-sro.com';
$adress = "Prague, Lumirova 27, 12800";
require("./people.php");
?>

<?php require("./header.php");
?>

<body>
    <h1 class="centeredText">My PHP Business Card</h1>
    <div class="container">
        <?php foreach ($people as $person) : ?>
            <div class="bc-front">
                <div class="icon">
                    <img class="icon" src="img/pok-choi.png" alt="Pok Choi">
                </div>
                <div class="contacts">
                    <div class="bc-name"><?php echo $person->getFullName(); ?> </div>
                    <div class="bc-age"><?php echo $person->getAge() . ' y.o.'?> </div>
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
                </div>
                <div class='line'></div>
                <div class='contacts-back'>
                    <div class="bc-phone"><?php echo $person->getPhone(); ?> </div>
                    <div class="bc-adress"><?php echo $adress; ?> </div>
                    <div class='bc-email'><?php echo $personFunctions->createEmail(str_replace(" ","",$person->getFullName())); ?></div>
                    <div class='bc-website'><?php echo $website ?></div>
                </div>
                <div class='bc-isWorking'><?php if ($person ->getIsWorking()) {
                                                echo '<p style="color:lightgreen">' . 'Available for contact' . '</p>';
                                            } else {
                                                echo '<p style="color:red">' . 'Not available for contact' . '</p>';
                                            } ?></div>


            </div>
        <?php endforeach; ?>
    </div>
</body>