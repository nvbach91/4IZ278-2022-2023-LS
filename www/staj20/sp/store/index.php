<!DOCTYPE html>
<?php
const DEFAULT_LIMIT = 3;
session_start();
require_once __DIR__ . '/../assets/php/core.php';

if(isset($_GET['from']) && isset($_GET['limit'])){
    $from = verify($_GET['from']);
    $limit = verify($_GET['limit']);
}
else{
    $from = 1;
    $limit = DEFAULT_LIMIT;
}
$productsClass = new Products();
$productAmount = $productsClass->getProductAmount();
if(isset($_GET['next'])){
    $from = $from + $limit;
}
if(isset($_GET['back'])){
    $from = $from - $limit;
}
if($from > $productAmount) $from = $productAmount;
if($from < 1) $from = 1;
if($limit < 1) $limit = 1;

$to = $from + $limit;

$products = $productsClass->showSomeProducts($from,$limit);
?>

<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Obchod - Staromor</title>
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
                <a class="nav-item-current" href="../store">
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
            <h1>Obchod - Staromor</h1>
            <form>
                
                <?php if($from > 1): ?>
                <button class="link-button" type="submit" name="back">Zpět</button>
                <?php endif; ?>
                <?php for($countfrom = 1;$countfrom <= $productAmount;$countfrom = $countfrom + $limit){
                    $to = $countfrom + $limit - 1;
                    if($to > $productAmount) $to = $productAmount;
                    ?>
                    <a href="?from=<?php echo $countfrom;?>&limit=<?php echo $limit;?>">[<?php echo $countfrom;?>-<?php echo $to;?>]</a>
                    <?php
                }
                ?>
                <?php if($from + $limit <= $productAmount): ?>
                <button class="link-button" type="submit" name="next">Další</button>
                <?php endif; ?>
                <input type="hidden" name="from" value=<?php echo $from; ?>>
                <label for="limit">Počet produktů na stránku</label> 
                <input name="limit" type="number" required min=1 value=<?php echo $limit; ?>>
                <button class="link-button" type="submit">Obnovit</button>

            </form>
            <nav class="store-page">
                <?php
                foreach($products as $product){
                    $id = $product['product_id'];
                    $name = $product['name'];
                    $desc = $product['description'];
                    $img = $product['img'];
                    $price = $product['price'];
                    $stock = $product['stock'];

                    ?>
                <div class="store-box">
                    <div class="store-image">
                        <img src="../<?php echo $img; ?>" alt="<?php echo $desc; ?>">
                    </div>

                    <a class="link-button" href="producta.php?id=<?php echo $id; ?>"><?php echo $name; ?></a>
                    <p class="price"><?php echo $price; ?> Kč</p>
                    <p><?php echo $stock; ?> skladem</p>
                </div>
                <?php } ?>
                
            </nav>
            
        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>