<?php
require './data.php';

$heading = "Business cards vol. 2";
?>

<?php include './head.php' ?>

<body>
    <h1><?php echo $heading ?></h1>
    <main>
        <?php include './business-cards.php' ?>
    </main>
</body>

<?php include './footer.php'?>
