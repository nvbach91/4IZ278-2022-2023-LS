    <?php
    session_start();
    require_once 'auth.php';
    requireLogin();

    $records = [];
    $cart = [];

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
            $ids = implode(',', array_values($cart));
            $statement = $pdo->prepare("SELECT * FROM sp_products WHERE good_id IN ($ids)");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        if (!empty($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            $records = fetchCartItems($pdo, $cart);
        }
    }
    ?>
    <?php require_once 'totalPrice.php'; ?>
    <?php require __DIR__ . '/header.php'; ?>

    <body class="container">
        <?php require __DIR__ . '/navbar.php'; ?>
        <h3 class="mb-4">Cart</h3>
        <div class="cards-wrapper">
            <?php foreach ($records as $item) : ?>
                <div class="col-md-12 pb-2">
                    <div class="card h-100 item-card">
                        <div class="row no-gutters">
                            <div class="col-md-2">
                                <img src="<?php echo $item['img']; ?>" class="card-img" alt="<?php echo $item['name']; ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body d-flex align-items-center">
                                    <h4 class="text-center"><?php echo $item['name']; ?></h4>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <div class="text-center">
                                    <span class="price"><?php echo $item['price']; ?> €</span>
                                    <a class="btn btn-outline-secondary" href="./cart-itemquantity.php?action=increment&good_id=<?php echo $item['good_id'] ?>">+</a>
                                    <span class="quantity">
                                        <?php
                                        $quantity = isset($cart[$item['good_id']]) ? $cart[$item['good_id']] + 1 : 1;
                                        echo $quantity;
                                        ?>
                                    </span>
                                    <a class="btn btn-outline-secondary" href="./cart-itemquantity.php?action=decrement&good_id=<?php echo $item['good_id'] ?>">-</a>
                                    <a class="btn btn-outline-primary" href="./remove-item.php?good_id=<?php echo $item['good_id'] ?>">X</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-md-12 pb-2">
                <div class="card h-100 item-card">
                    <div class="row no-gutters">
                        <div class="col-md-8">
                            <div class="card-body d-flex align-items-center">
                                <h4 class="text-center">Total Price: <?php echo $totalPrice;?> €</h4>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <form action="place-order.php" method="post">
                                <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
                                <button class="btn btn-primary" name="paymentMethod" value="card">Pay by Card</button>
                                <button class="btn btn-primary" name="paymentMethod" value="cash">Pay by Cash</button>
                            </form>
        </div>
    

    </body>



    <?php require __DIR__ . '/footer.php'; ?>



