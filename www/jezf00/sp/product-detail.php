<?php
require_once './productDatabase.php';

function getItemById($pdo, $id)
{
    $statement = $pdo->prepare('SELECT * FROM sp_products WHERE good_id = :good_id');
    $statement->execute(['good_id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

require_once 'dbconfig.php';
$pdo = new PDO(
    'mysql:host=' . DB_HOST .
    ';dbname=' . DB_NAME .
    ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);


if (isset($_GET['good_id'])) {
    $productDb = new ProductsDatabase();
    $product = getItemById($pdo, $_GET['good_id']);

    if (!$product) {
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>
<?php require __DIR__ . '/header.php'; ?>


    
<div class="container mt-3">
    <?php require __DIR__ . '/navbar.php'; ?>
    <div class="row">
    <div class="col-md-4">
    <img class="card-img-top item-image" src="<?php echo $product['img']; ?>">
    </div>

        <div class="col-md-8">
            <h4 class="card-title red"><?php echo $product['name']; ?></h4>
            <p class="card-text"><?php echo $product['description']; ?></p>
            <h5><?php echo $product['price'] . ' €' ?></h5>
            <div class="card-footer">
                <a class="btn card-link btn-outline-primary" href="./buy.php?good_id=<?php echo $product['good_id']; ?>">Buy</a>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['privilege'] >= 2) : ?>
                    <a class="btn btn-outline-secondary" href="./edit-item.php?good_id=<?php echo $product['good_id']; ?>">Edit</a>
                    <a class="btn btn-outline-secondary" href="./delete-item.php?good_id=<?php echo $product['good_id']; ?>">Delete</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



<?php require __DIR__ . '/footer.php'; ?>   
