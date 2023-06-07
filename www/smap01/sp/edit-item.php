<?php
require_once("./incl/header.php");
require_once("./database/ProductsDB.php");
require_once("./database/UsersDB.php");

if (empty($_COOKIE) || !isset($_COOKIE['user_email'])) {
    header('Location: login.php');
    exit;
}
$productsDB = ProductsDB::getDatabase();
$usersDB = UsersDB::getDatabase();

//Uses pessimistic access, time duration during which another user but the one editing cannot edit the book is set to $timeLen
if (isset($_GET['book_id'])&&isset($_COOKIE['user_email'])) {
    $timeLen=120;
    $edited = $productsDB->getEdited($_GET['book_id']);
    if (time() - $edited['opened_at'] < $timeLen && strcmp(strtolower($_COOKIE['user_email']), strtolower($edited['edited_by'])) != 0) {
        echo "This books is already being edited. Try it again later.";
        exit;
    } else {
        $productsDB->setEdited($_GET['book_id'], $_COOKIE['user_email'], time());
    }
}

$item;

//Verifies input and updates a book record. If successful forwards user to index.php?update=success otherwise shows and error message
if (!empty($_POST) && isset($_POST['book_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['authors']) && isset($_POST['thumbnail']) && $usersDB->getUserPrivilege($_COOKIE['user_email']) >= 2) {
    $result = verifyInput($_POST['book_id'], $_POST['name'], $_POST['authors'], $_POST['description'], $_POST['thumbnail'], $_POST['price']);
    if (strlen($result) == 0) {
        $result = $productsDB->updateBook($_POST['book_id'], filter_var($_POST['name'], FILTER_UNSAFE_RAW), filter_var($_POST['authors'], FILTER_UNSAFE_RAW), filter_var($_POST['description'], FILTER_UNSAFE_RAW), $_POST['thumbnail'], $_POST['price']);
        if ($result == null) {
            header('Location: index.php?update=success');
            exit;
        } else {
            echo $result;
        }
    } else {
        echo "<div style='background-color:red;color:white;text-align:center;'><a>" . $result . ".</a></div>";
    }
}

//Function that verifies input
function verifyInput($bookId, $bookName, $bookAuthors, $bookDescription, $bookThumbnail, $bookPrice)
{
    $result = "";
    if (!filter_var($bookId, FILTER_VALIDATE_INT)) {
        $result .= "Book ID must be an integer ";
    }
    if (strcmp($bookName, htmlspecialchars($bookName)) != 0) {
        $result .= "Book name cannot contain special characters.";
    }
    $pattern = "/^(([a-zA-ZÁÉÍÓÚÝÄČĎĚÏŇÖŘŠŤÜÛÝŽáéíóúýäčďěïňöřšťüûýž]+)(.)?(,)?( )?)+$/";
    if (!preg_match($pattern, $bookAuthors)) {
        $result .= "Book author name is in a wrong format. ";
    }
    if (!filter_var($bookPrice, FILTER_VALIDATE_FLOAT)) {
        $result .= "Price must be an int or float. ";
    }
    if (!filter_var($bookThumbnail, FILTER_VALIDATE_URL)) {
        $result .= "Thumbnail must be a url of an image. ";
    }
    return $result;
}

if (isset($_GET['book_id']) && $productsDB->getBook($_GET['book_id'])) {
    $item = $productsDB->getBook($_GET['book_id']);
} else if (empty($_POST)) {
    header('Location: index.php');
}
?>
<main class="container" style="max-width: 60% !important;">
    <h1 style='margin-bottom:50px;text-align:center;'>Edit an item</h1>
    <?php

    if (!isset($_COOKIE['user_email'])) {
        echo "<h2 style='margin-top:50px;text-align:center'>You have to be logged in in order to edit a new item.</h2>";
    } else if ($usersDB->getUserPrivilege($_COOKIE['user_email']) < 2) {
        echo "<h2 style='margin-top:50px;text-align:center'>You can't edit new items.</h2>";
    } else {
        echo "<form action='edit-item.php' method='POST'>
        <div class='add-2'>
        <div style='display:flex;flex-direction:column;'>
        <label class='validationDefault04'>ID</label>
        <input class='form-control' id='validationDefault04' required type='text' value='";
        echo isset($item) ? $item['book_id'] : '';
        echo "' name='book_id' readonly>
        <label class='validationDefault01'>Name</label>
        <input class='form-control' id='validationDefault01' required type='text' value='";
        echo isset($item) ? $item['book_name'] : '';
        echo "' name='name'>
        <label class='validationDefault01'>Authors</label>
        <input class='form-control' id='validationDefault01' required type='text' value='";
        echo isset($item) ? $item['book_author'] : '';
        echo "' name='authors'>
        <label class='validationDefault02'>Description</label>
        <textarea class='form-control' type='text' id='validationDefault02' required name='description'>";
        echo isset($item) ? $item['book_description'] : '';
        echo "</textarea>
        <div class='add-2c'><div>
        <label class='validationDefault03'>Thumbnail url</label>
        <input class='form-control' type='text' id='validationDefault03' required value='";
        echo isset($item) ? $item['thumbnail_url'] : '';
        echo "' name='thumbnail'>
        </div>
        <div>
        <label class='validationDefault03'>Price</label>
        <input class='form-control' type='text' id='validationDefault03' required value='";
        echo isset($item) ? $item['price'] : '';
        echo "' name='price'>
        </div>
        </div>
        </div>
        <button class='btn'>Save</button>
        </div>
        </form>";
    }

    ?>
</main>
<?php require_once("./incl/footer.php"); ?>