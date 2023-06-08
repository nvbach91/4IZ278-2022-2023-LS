<?php require_once __DIR__ . '/incl/header.php'; ?>
<?php require_once __DIR__ . '/database/ProductsDB.php';?>
<?php
$productsDB=ProductsDB::getDatabase();
$usersDB=UsersDB::getDatabase();
$offset;

//First enter and input tests
if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

//Gets books pagination
$itemsCountPerPage = 5;
$descrLen=100;
$books = $productsDB->getItemByOffset($offset, $itemsCountPerPage);
$paginationCount = ceil($productsDB->getCountOfTotalRecord() / $itemsCountPerPage);


?>
<main class="container">
    <?php if (isset($_GET['update']) && $_GET['update'] == 'success') {
        echo
        '<div style="margin-top:10px;background-color:green;padding:10px;text-align:center;">
                <a style="color:white;"><i style="margin-right:10px;" class="fa-sharp fa-solid fa-check"></i>Item was successfully edited</a>
            </div>';
    } ?>
    <div class="pagination-column">
        <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
            <div class="pagination"><a href="<?php echo './index.php?offset=' . $i * $itemsCountPerPage; ?>">
                <?php echo $i + 1; ?>
            </a></div>
        <?php } ?>
    </div>
    <div class="row">
        <?php
        foreach ($books as $book) {
            $descrTooLong=(strlen($book['book_description'])>50)?"...":"";
            echo "<div class='card' style='width: 18rem;padding-bottom:110px;'>
            <div class='card-img-wrap'>
            <img class='card-img-top' src='".$book['thumbnail_url']."' alt='Card image cap'>
            </div>
            <div class='card-body'>
              <a href=book-detail.php?book_id=".$book['book_id']."><h5 class='card-title'>" . $book["book_name"] . "</h5></a>
              <p class='card-text'>" . substr($book["book_description"], 0, $descrLen) . $descrTooLong ."</p>
              <p class='card-text' style='bottom:70px !important;position:absolute;'>$" . $book["price"] . "</p>
              <div style='bottom: 20px !important; position: absolute;'>
                <a href='actions/add-to-cart.php?book_id=" . $book["book_id"] . "' style='margin-right:4px;' class='btn btn-primary'>Buy</a>";
            echo (!empty($_COOKIE['user_email'])&&$usersDB->getUserPrivilege($_COOKIE['user_email'])>1) ? ("<a href='edit-item.php?book_id=" . $book["book_id"] . "' class='btn btn-warning'><i class='fa-solid fa-pen'></i></a>
                <a href='actions/delete-item.php?book_id=" . $book["book_id"] . "' class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></a>") : "";
            echo "</div>
            </div>
          </div>";
        }


        ?>
    </div>
</main>
<?php require_once __DIR__ . '/incl/footer.php'; ?>