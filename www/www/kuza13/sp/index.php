<?php
require('./vendor/autoload.php');
require('header.php');
include('headline.php');
require('./db/ProductDatabase.php');
require('./db/CategoriesDatabase.php');
require('./db/DiscountProductsDB.php');
require('./db/UsersDatabase.php');
require('./db/OrdersDatabase.php');
if (!isset($_SESSION)) {
    session_start();
};
?>

<body>
    <?php
    $productDB = new ProductDatabase();
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 8;
    $offset = $limit * ($page - 1);
    $totalPages = ceil($productDB->countRow('products') / $limit);
 
    if (isset($_GET['category_id'])) {
        $products = $productDB->fetchByCategory($_GET['category_id']);
    } else {
        $products = $productDB->fetchAllWithLimit($offset, $limit);
    }
    ?>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>