<?php

include './app/DatabaseOperations.php';
include './app/Database.php';
include './app/OrdersDB.php';
include './app/ProductsDB.php';
include './app/UsersDB.php';

$title = 'Database OOP example';
$header = 'Database OOP Interface example';

?>

<?php include __DIR__ . '/head.php' ?>

<body>
    <h1><?php echo $header; ?></h1>
    <?php include './test.php'; ?>
</body>

<?php include __DIR__ . '/footer.php' ?>