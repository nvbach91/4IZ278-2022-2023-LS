<?php
require_once("./incl/header.php");
require_once(__DIR__."/database/Database.php");
require_once(__DIR__."/database/ProductsDB.php");

if(empty($_COOKIE)||!isset($_COOKIE['user_email'])){
    header('Location: login.php');
    exit;
}
$database = new ProductsDB();

$item;
if (!empty($_POST) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])&&$database->getUserPrivilege($_COOKIE['user_email'])>1) {
    $result = $database->updateItem($_POST['good_id'], $_POST['name'], $_POST['description'], $_POST['price']);
    if($result==null){
        header('Location: index.php?update=success');
        exit;
    }else{
        echo $result;
    }
}

if (isset($_GET['good_id']) && $database->getItem($_GET['good_id'])) {
    $item = $database->getItem($_GET['good_id']);
} else if (empty($_POST)) {
    header('Location: index.php');
}
?>
<main class="container" style="max-width: 60% !important;">
    <h1 style='margin-bottom:50px;text-align:center;'>Edit an item</h1>
    <?php

    if (!isset($_COOKIE['user_email'])) {
        echo "<h2 style='margin-top:50px;text-align:center'>You have to be logged in in order to edit a new item.</h2>";
    } 
    else if($database->getUserPrivilege($_COOKIE['user_email'])<2){
        echo "<h2 style='margin-top:50px;text-align:center'>You can't edit new items.</h2>";
    }else {
        echo "<form action='edit-item.php' method='POST'>
        <div style='display:flex;flex-direction:column;'>
        <label class='validationDefault04'>ID</label>
        <input class='form-control' id='validationDefault04' required type='text' value='";
        echo isset($item) ? $item['good_id'] : '';
        echo "' name='good_id' readonly>
        <label class='validationDefault01'>Name</label>
        <input class='form-control' id='validationDefault01' required type='text' value='";
        echo isset($item) ? $item['name'] : '';
        echo "' name='name'>
        <label class='validationDefault02'>Description</label>
        <input class='form-control' type='text' id='validationDefault02' required value='";
        echo isset($item) ? $item['description'] : '';
        echo "' name='description'>
        <label class='validationDefault03'>Price</label>
        <input class='form-control' type='text' id='validationDefault03' required value='";
        echo isset($item) ? $item['price'] : '';
        echo "' name='price'>
        <button class='btn' style='margin-top:10px;margin-left:auto;width:60px;position:revert;'>Save</button>
        </div>
        </form>";
    }

    ?>
</main>
<?php require_once("./incl/footer.php"); ?>