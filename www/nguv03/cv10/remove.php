<?php
// pripojeni do db
require 'db.php';

// pristup jen pro prihlaseneho uzivatele
require 'user_required.php';

// zrusime id zbozi ze session
// nekontrolujeme, jestli tam je

$id = $_GET['product_id'];

//var_dump($_SESSION['cart']);

foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}

header('Location: cart.php');
exit();

?>