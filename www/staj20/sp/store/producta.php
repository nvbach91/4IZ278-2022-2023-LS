<?php
session_start();
$product_id = $_GET['id'];
require_once __DIR__ . '/../assets/php/core.php';
$csrf_good = csrf_check();
$product = new Product($product_id);
$productdata = $product->showProduct();
$name = $productdata['name'];
$iname = $productdata['internal_name'];
$desc = $productdata['description'];
$desc_long = $productdata['description_long'];
$img = $productdata['img'];
$price = $productdata['price'];
$stock = $productdata['stock'];

if(isset($_POST['product-quantity']) && $csrf_good){
    $quantity = verify($_POST['product-quantity']);
    if($quantity > 0 && $quantity <= $stock){
        $cart = unserialize($_SESSION['cart']);
        $cart->addProduct($product_id,$quantity);    
        $_SESSION['cart'] = serialize($cart);
        header("Location: ../cart");
    }
}
?>


<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $name; ?> - Staromor</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css">
    <link rel="stylesheet" media="print" href="../assets/css/print.css">
    <meta name="keywords" content="Obchod, Starožitnosti, Starožitnost, sklo, porcelán, kvalitní">
    <meta name="description" content="Obchod se starožitnosti">
    <meta name="author" content="Jakub Starosta">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="wrapper">
        <header>
            <nav class="nav-list">
                <a class="nav-item" href="../">
                    <p>Staromor</p>
                </a>
                <a class="nav-item" href="../store">
                    <p>Obchod</p>
                </a>
                <a class="nav-item" href="../account">
                    <p>Uživatelský účet</p>
                </a>
                <a class="nav-item" href="../cart">
                    <p>Nákupní košík</p>
                </a>
            </nav>
        </header>
        <main>
            <h1><?php echo $name; ?> - Staromor</h1>
            <div class="product-page">
                <div class="product-desc">
                    <p><?php echo $desc_long; ?></p>
                    <p class="price"><?php echo $price; ?> Kč</p>
                    
                    <?php if( $stock > 0) { ?>
                    <p><?php echo $stock; ?> skladem</p>
                    <form method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">             
                        <label for="product-quantity">Množství:</label>
                        <input type="number" id="product-quantity" name="product-quantity" min="1" max="<?php echo $stock; ?>" value="1">
                        <input type="submit" value="Přidat do košíku">
                    </form>
                    <?php } else{
                        ?><p>Produkt není skladem</p><?php
                    } ?>

                </div>
                <div class="product-image">
                    <img src="../<?php echo $img; ?>" alt="<?php echo $desc; ?>">
                </div>
            </div>
        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>