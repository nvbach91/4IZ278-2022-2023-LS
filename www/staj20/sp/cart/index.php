<?php
session_start();
require_once __DIR__ . '/../assets/php/core.php';
$cart = unserialize($_SESSION['cart']);
//secho $_SESSION['cart'];
$csrf_good = csrf_check();
if(isset($_POST["update"]) && $csrf_good){
    $ids = $cart->getIds();
    foreach($ids as $id){
        if(isset($_POST["remove_" . $id])){
            $cart->removeProduct($id);
        }
        else{
            if(verify($_POST["amount_" . $id]) > 0){
                $cart->changeAmount($id,verify($_POST["amount_" . $id]));
            }
        }
    }
    $_SESSION['cart'] = serialize($cart);
}
$cartproducts = $cart->showCart();

if(isset($_POST["order"]) && $csrf_good){
    header("Location:  orderaddress.php");
}
$totalprice = 0;

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Staromor</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css">
    <link rel="stylesheet" media="print" href="../assets/css/print.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Obchod, Starožitnosti, Starožitnost, sklo, porcelán, kvalitní">
    <meta name="description" content="Obchod se starožitnosti">
    <meta name="author" content="Jakub Starosta">
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
                <a class="nav-item-current" href="../cart">
                    <p>Nákupní košík</p>
                </a>
            </nav>
        </header>
        <main>
            <h1>Košík</h1>
            <nav class="cart-page">
                <?php
                if (isset($cartproducts)) {
                ?>
                    <form method="post">
                    <input type="hidden" name="update" value="update">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">             
                    <table>
                        <tr>
                            <th>Obrázek</th>
                            <th>Produkt</th>
                            <th>Cena</th>
                            <th>Skladem</th>
                            <th>Množství</th>
                            <th>Celková cena</th>
                            <th>Zrušit</th>
                        </tr>

                        <?php
                        foreach ($cartproducts as $cartproduct) {
                            $id = $cartproduct['product_id'];
                            $name = $cartproduct['name'];
                            $desc = $cartproduct['description'];
                            $img = $cartproduct['img'];
                            $price = $cartproduct['price'];
                            $stock = $cartproduct['stock'];
                            $amount = $cart->getAmount($id);
                            $totalprice += $price * $amount;

                        ?>
                            <tr>
                                <th><img class="mini-img" src="../<?php echo $img; ?>" alt="<?php echo $desc; ?>"></th>
                                <th><a class="link-button" href="../store/producta.php?id=<?php echo ($id) ?>"><?php echo $name; ?></a></th>
                                <th><?php echo $price; ?> Kč</th>
                                <th><?php echo $stock; ?> skladem</th>
                                <th><input type="number" name="amount_<?php echo $id; ?>" min="1" max="<?php echo $stock; ?>" value="<?php echo $amount; ?>"></th>
                                <th><?php echo ($price * $amount); ?> Kč</th>
                                <th><button class="link-button" type="submit" name="remove_<?php echo $id; ?>">Zrušit</button></th>

                            </tr>
                        <?php

                        }
                        ?>
                    </table>
                    <p>Celková cena: <?php echo $totalprice; ?> Kč</p>
                    <button class="link-button" type="submit">Přepočítat cenu</button>
                    <button class="link-button" type="submit" name="order">Pokračovat na objednávku</button>
                    
                    </form>
                <?php
                } else {
                ?>
                    <p>Košík je prázdný.</p>
                    <a class="link-button" href="../store/">Nakupte si něco</a>
                <?php
                }
                ?>
            </nav>
        </main>
        <footer>
            <p>Staromor, Copyright 2022</p>
        </footer>
    </div>
</body>

</html>