<?php
$records = [];

session_start();

if (isset($_SESSION['cart'])) {
    require_once 'dbconfig.php';
    $pdo = new PDO(
        'mysql:host=' . DB_HOST .
            ';dbname=' . DB_NAME .
            ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );

    function fetchCartItems($pdo, $cart)
    {
        $ids = implode(',', $cart);
        $statement = $pdo->prepare("SELECT * FROM cv09_goods WHERE good_id IN ($ids)");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    if (!empty($_SESSION['cart'])) {
        $records = fetchCartItems($pdo, $_SESSION['cart']);
    }
}

?>


<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h3 class="mb-4">Cart</h3>
    <div class="cards-wrapper">
        <?php foreach ($records as $item) : ?>
            <div class="col-md-4 pb-2">
                <div class="card h-100 item-card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="#"><?php echo $item['name']; ?></a></h4>
                        <h5><?php echo $item['price'] . ' €' ?></h5>
                        <p class="card-text"><?php echo $item['price']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a class="btn card-link btn-outline-primary" href="./remove-item.php?good_id=<?php echo $item['good_id'] ?>">Remove</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

<?php require __DIR__ . '/footer.php'; ?>