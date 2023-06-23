<?php
session_start();
require_once __DIR__ . '/../assets/php/core.php';
$csrf_good = csrf_check();
if (isset($_SESSION['cart']) && isset($_SESSION['address'])) {
    $cart = unserialize($_SESSION['cart']);
    $address = unserialize($_SESSION['address']);
    $cartproducts = $cart->showCart();
    $totalprice = 0;
} else {
    header("Location:  index.php");
}
$failure = false;
if (isset($_GET['submit']) && $csrf_good) {
    foreach ($cartproducts as $cartproduct) {
        $id = $cartproduct['product_id'];
        $name = $cartproduct['name'];
        $desc = $cartproduct['description'];
        $img = $cartproduct['img'];
        $price = $cartproduct['price'];
        $stock = $cartproduct['stock'];
        $amount = $cart->getAmount($id);
        $totalprice += $price * $amount;

        if ($amount > $stock) {
            $failure = true;
        }
    }
    if (!$failure) {
        $order = new Order();
        $order->CreateOrder($cart, $address);
        unset($_SESSION['cart']);
        header("Location:  success.php");
    }
}
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
                <a class="nav-item" href="../cart">
                    <p>Nákupní košík</p>
                </a>
            </nav>
        </header>
        <main>
            <h1>Kontrola objednávky</h1>
            <?php if ($failure) : ?>
                <p class="bold">Omlouváme se, ale některé z produktů, které máte v košíku už nejsou dostupné. Prosím klikněte na tlačtko "Změnit obsah košíku".</p>
            <?php endif; ?>
            <?php if (!isset($_SESSION['user_id'])) : ?>
                <p class="bold">Nejste přihlašený. Varujeme, že pouze přihlášení uživatele mohou sledovat objednávky.</p>
            <?php endif; ?>

            <h2>Košík</h2>
            <form action="index.php">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">             
                <button class="link-button" type="submit">Změnit obsah košíku</button>
            </form>
            <nav class="cart-page">
                <?php
                if (isset($cartproducts)) {
                ?>
                    <input type="hidden" name="update" value="update">
                    <table>
                        <tr>
                            <th>Obrázek</th>
                            <th>Produkt</th>
                            <th>Cena</th>
                            <th>Skladem</th>
                            <th>Množství</th>
                            <th>Celková cena</th>
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
                                <th><?php echo $amount; ?></th>
                                <th><?php echo ($price * $amount); ?> Kč</th>

                            </tr>
                        <?php

                        }
                        ?>
                    </table>
                    <p>Celková cena: <?php echo $totalprice; ?> Kč</p>
                <?php
                } else {
                ?>
                    <p>Košík je prázdný.</p>
                    <a class="link-button" href="../store/">Nakupte si něco</a>
                <?php
                }
                ?>
            </nav>
            <h2>Dodací adresa</h2>
            <?php if(!isset($_SESSION['user_id'])): ?>
            <form action="orderaddress.php">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">             
                <button class="link-button" type="submit" name="change-address">Změnit adresu</button>
            </form>
            <?php endif; ?>
            <?php if(isset($_SESSION['user_id'])): ?>
            <form action="../account/useraddress.php">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">             
                <button class="link-button" type="submit" name="change-address">Změnit adresu</button>
            </form>
            <?php endif; ?>


            <table>
                <tr>
                    <th><label for="name">Jméno:</label></th>
                    <th><?php echo $address->name; ?></th>
                </tr>
                <tr>
                    <th><label for="street">Ulice:</label></th>
                    <th><?php echo $address->street; ?></th>
                </tr>
                <tr>
                    <th><label for="zip">PSČ:</label></th>
                    <th><?php echo $address->zip; ?></p>
                    </th>
                </tr>
                <tr>
                    <th><label for="city">Město:</label></th>
                    <th><?php echo $address->city; ?></th>
                </tr>
                <tr>
                    <th><label for="country">Stát:</label></th>
                    <th><?php echo $address->country; ?></th>
                </tr>
                <tr>
                    <th><label for="email">Email:</label></th>
                    <th><?php echo $address->email; ?></th>
                </tr>
                <?php if ($address->phone != "") { ?>
                    <tr>
                        <th><label for="phone">Telefon:</label></th>
                        <th><?php echo $address->phone; ?></th>
                    </tr>
                <?php }
                if ($address->additional_info != "") { ?>
                    <tr>
                        <th><label for="additional_info">Další informace pro dodání:</label></th>
                        <th><?php echo $address->additional_info; ?></th>
                    </tr>
                <?php } ?>
            </table>
            <?php if (!$failure) { ?>
                <p>Prosím zkontrolujete, že všechny údaje jsou správné před potrvzením objednávky.</p>
                <form>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">             
                    <button class="link-button" type="submit" name="submit">Potvrdit objednávku</button>
                </form>
            <?php } ?>

        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>