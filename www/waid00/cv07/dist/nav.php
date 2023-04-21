    <!-- Navigation-->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Eshop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-ite nav-item"><a class="nav-link" href="settings.php"><?php echo $_SESSION['login']; ?></a></li>
                    <li class="nav-ite nav-item"><a class="nav-link" href="addItem.php"><?php echo 'addItem'; ?></a></li>
                    <li class="nav-ite nav-item"><a class="nav-link" href="logout.php">logout</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $stmt = $pdo->prepare('SELECT * FROM products');
                            $stmt->execute();
                            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <form action="get">
                                <li><a class="dropdown-item" href="index.php" name="all">All Products</a></li>
                            </form>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <?php
                            foreach ($categories as $category) : ?>
                                <li><a class="dropdown-item" href="index.php?id=<?= htmlspecialchars($category['category_id']) ?>">
                                        <?= htmlspecialchars($category['name']) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" method="post">
                    <button class="btn btn-outline-dark" type="submit" name="cart">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $result['order_count']; ?></span>
                    </button>
                </form>
            </div>
        </div>
    </nav>