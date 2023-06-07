<?php
require_once './incl/header.php';
require_once './database/ProductsDB.php';
?>
<?php

//First enter tests
if (empty($_COOKIE) || !isset($_COOKIE['user_email'])) {
    header('Location: ./login.php');
    exit;
}
$productsDB = ProductsDB::getDatabase();
$usersDB = UsersDB::getDatabase();

//If successful adds a book record to the database and forwards user to index.php
if (!empty($_POST) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['authors'])&&isset($_POST['thumbnail'])&& $usersDB->getUserPrivilege($_COOKIE['user_email']) >= 2) {
    $result=verifyInput($_POST['name'], $_POST['authors'], $_POST['description'], $_POST['thumbnail'], $_POST['price']);
    if (strlen($result)==0) {
        $result = $productsDB->insertItem(filter_var($_POST['name'], FILTER_UNSAFE_RAW), filter_var($_POST['authors'], FILTER_UNSAFE_RAW), filter_var($_POST['description'], FILTER_UNSAFE_RAW),filter_var($_POST['thumbnail'],FILTER_UNSAFE_RAW), filter_var($_POST['price'], FILTER_UNSAFE_RAW));
        if ($result == null) {
            header('Location: ./index.php');
            exit;
        } else {
            echo $result;
        }
    }else{
        echo $result;
    }
}

//Function for verifying input. Returns result which is 0 characters long if successful otherwise send String with error messages
function verifyInput($bookName, $bookAuthors, $bookDescription, $bookThumbnail, $bookPrice){
    $result="";
    if(strcmp($bookName,htmlspecialchars($bookName))!=0){
        $result.="Book name cannot contain special characters.";
    }
    $pattern="/^(([a-zA-ZÁÉÍÓÚÝÄČĎĚÏŇÖŘŠŤÜÛÝŽáéíóúýäčďěïňöřšťüûýž]+)(.)?(,)?( )?)+$/";
    if(!preg_match($pattern, $bookAuthors)){
        $result.="Book author name is in a wrong format.";
    }
    if(!filter_var($bookPrice, FILTER_VALIDATE_FLOAT)){
        $result.="Price must be an int or float.";
    }
    if(!filter_var($bookThumbnail, FILTER_VALIDATE_URL)){
        $result.="Thumbnail must be a url of an image.";
    }
    return $result;
}
?>
<main class="container" style="max-width: 60% !important;">
    <h1 style='margin-bottom:50px;text-align:center;'>Add an item</h1>
    <?php

    if (!isset($_COOKIE['user_email'])) {
        echo "<h2 style='margin-top:50px;text-align:center'>You have to be logged in in order to create a new item.</h2>";
    } else if ($usersDB->getUserPrivilege($_COOKIE['user_email']) < 2) {
        echo "<h2 style='margin-top:50px;text-align:center'>You can't add new items.</h2>";
    } else {
        echo "<form action='add-a-book.php' method='POST'>
        <div class='add-2'>
            <div style='display:flex;flex-direction:column;'>
                <label class='validationDefault01'>Book name</label>
                <input class='form-control' id='validationDefault01' required type='text' name='name'>
                <label class='validationDefault01'>Author/s</label>
                <input class='form-control' id='validationDefault04' required type='text' name='authors'>
                <label id='validationDefault02'>Description</label>
                <textarea class='form-control' type='text' id='validationDefault02' required name='description'></textarea>
                <div class='add-2c'>
                    <div>
                        <label class='validationDefault05'>Thumbnail url</label>
                        <input class='form-control' type='text' id='validationDefault03' required name='thumbnail'>
                    </div>
                    <div>
                        <label class='validationDefault03'>Price</label>
                        <input class='form-control' type='text' id='validationDefault03' required name='price'>
                    </div>
                </div>
            </div>
            <button class='btn'>Add</button>
        </div>
    </form>";
    }

    ?>
</main>
<?php require_once './incl/footer.php'; ?>