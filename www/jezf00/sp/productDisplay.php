<?php require_once './productDatabase.php' ?>

<?php
$productsDb = new ProductsDatabase();
$products = [];

if (isset($_GET['category_id']) && isset($_GET['sort']) && ($_GET['sort'] == 'asc' || $_GET['sort'] == 'desc')) {
    $category_id = $_GET['category_id'];
    $maxmin = ($_GET['sort'] == 'asc') ? 'min' : 'max';
    $products = $productsDb->fetchByCategoryAndPrice($category_id, $maxmin);
} elseif (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $products = $productsDb->fetchByCategory($category_id);
} elseif (isset($_GET['sort']) && ($_GET['sort'] == 'asc' || $_GET['sort'] == 'desc')) {
    $maxmin = ($_GET['sort'] == 'asc') ? 'min' : 'max';
    $products = $productsDb->fetchByPrice($maxmin);
} else {
    $products = $productsDb->fetchAll();
}
?>

<div class="categoryDisplayContainer row">
    <?php foreach ($products as $item) : ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 item-card">
                <a href="./product-detail.php?good_id=<?php echo $item['good_id'] ?>">
                    <img class="card-img-top item-image" src="<?php echo $item['img']; ?>">
                </a>
                <div class="card-body">
                    <h4 class="card-title red">
                        <a href="./product-detail.php?good_id=<?php echo $item['good_id'] ?>">
                            <?php echo $item['name']; ?>
                        </a>
                    </h4>
                    <h5><?php echo $item['price'] . ' €' ?></h5>
                    <p class="card-text"><?php echo $item['description']; ?></p>
                </div>
                <div class="card-footer">
                    <a class="btn card-link btn-outline-primary" href="./buy.php?good_id=<?php echo $item['good_id'] ?>">Buy</a>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['privilege'] >= 2) : ?>
                        <a class="btn btn-outline-secondary" href="admin/edit-item.php?good_id=<?php echo $item['good_id'] ?>">Edit</a>
                        <a class="btn btn-outline-secondary" href="admin/delete-item.php?good_id=<?php echo $item['good_id'] ?>">Delete</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
