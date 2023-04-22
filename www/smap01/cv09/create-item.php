<?php
require_once __DIR__ . '/incl/header.php';
require_once __DIR__ . '/database.php';
?>

<?php
$database = new Database();
if (!empty($_POST) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])) {
    $result=$database->insertItem($_POST['name'], $_POST['description'], $_POST['price']);
    if ($result==null) {
        header('Location: index.php');
        exit;
    }else{
        echo $result;
    }
}
?>
<main class="container" style="max-width: 60% !important;">
    <h1 style='margin-bottom:50px;text-align:center;'>Add an item</h1>
    <?php

    if (!isset($_COOKIE['name'])) {
        echo "<h2 style='margin-top:50px;text-align:center'>You have to be logged in in order to create a new item.</h2>";
    } else {
        echo "<form action='create-item.php' method='POST'>
        <div style='display:flex;flex-direction:column;'>
        <label class='validationDefault01'>Name</label>
        <input class='form-control' id='class='validationDefault01' required type='text' name='name'>
        <label class='validationDefault02'>Description</label>
        <input class='form-control' type='text' id='validationDefault02' required name='description'>
        <label class='validationDefault03'>Price</label>
        <input class='form-control' type='text' id='validationDefault03' required name='price'>
        <button class='btn' style='margin-top:10px;margin-left:auto;width:60px;position:revert;'>Add</button>
        </div>
        </form>";
    }

    ?>
</main>
<?php require_once __DIR__ . '/incl/footer.php'; ?>