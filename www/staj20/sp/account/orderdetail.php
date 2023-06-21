<?php
session_start();
require_once __DIR__ . '/../assets/php/core.php';
if (!isset($_GET['order_id'])) {
    header('Location: index.php');
    exit;
}
$orderId = $_GET['order_id'];
$orderView = new Order();
if($_SESSION['user_id'] != $orderView->GetUserIdFromOrderId($orderId)){
    header('Location: index.php');
    exit;
}

$statuses = $orderView->GetOrderStatus($orderId);
$address = $orderView->GetOrderAddress($orderId);
$products = $orderView->GetOrderProducts($orderId);

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
                <a class="nav-item" href="../cart">
                    <p>Nákupní košík</p>
                </a>
            </nav>
        </header>
        <main>
            <h1>Detaily objednávky</h1>
            <a class="link-button" href="userorders.php">Zpět</a>
            <h2>Stav objednávky</h2>
            <table>
                <tr>
                    <th>Datum</th>
                    <th>Stav objednávky</th>
                    <th>Informace</th>
                </tr>
            
            
            <?php foreach($statuses as $status){
                ?>
                <tr>
                    <th><?php echo $status['date'];?></th>
                    <th><?php echo $status['status'];?></th>
                    <th><?php echo $status['information'];?></th>
                </tr>
            <?php } ?>
            </table>
            <h2>Objednané produkty</h2>
            <nav class="cart-page">
                <?php
                if (isset($products)) {
                ?>
                    <input type="hidden" name="update" value="update">
                    <table>
                        <tr>
                            <th>Obrázek</th>
                            <th>Produkt</th>
                            <th>Cena</th>
                            
                            <th>Množství</th>
                            <th>Celková cena</th>
                        </tr>

                        <?php
                        $totalprice = 0;
                        foreach ($products as $product) {
                            $id = $product['product_id'];
                            $name = $product['name'];
                            $desc = $product['description'];
                            $img = $product['img'];
                            $price = $product['current_price'];
                            $stock = $product['stock'];
                            $amount = $product['amount'];
                            $totalprice += $price * $amount;
                        
                        ?>
                            <tr>
                                <th><img class="mini-img" src="../<?php echo $img; ?>" alt="<?php echo $desc; ?>"></th>
                                <th><a class="link-button" href="../store/producta.php?id=<?php echo ($id) ?>"><?php echo $name; ?></a></th>
                                <th><?php echo $price; ?> Kč</th>
                                
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
                    <p>Objednávka je prázdná. Tohle by se nemělo stát.</p>
                <?php
                }
                ?>
            </nav>
            <h2>Dodací adresa</h2>
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
            

        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>