<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Cart.php';

if (!isset($_SESSION['cart_id'])) {
    echo "Pred pokračovaním sa musíte prihlásiť.";
    echo "<a href='login.php'><button type='submit' name='login'>Prihlásiť sa</button></a>";
    exit();
}

$cart_id = $_SESSION['cart_id'];

$db = new Database();
$cart = new Cart($db);

// Retrieve the cart items
$cartItems = $cart->getCartItems($cart_id);
$totalCartPrice = 0;

// Your HTML goes here...
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Cart</title>
    <?php include 'meta.php'; ?>
</head>
<body>

<?php include 'header.php';?>

<header>
    <h1>Nákupný košík</h1>
</header>

<?php if (count($cartItems) > 0): // Only show if there are items in the cart
    foreach ($cartItems as $item): 
        $totalPriceForThisItem = $item['price'] * $item['quantity'];
        $totalCartPrice += $totalPriceForThisItem;
    ?>

<div class="cart-item">
    <img src="<?= htmlspecialchars($item['photo'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?>"/>
    <h3><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></h3>
    <p>Cena: <?= htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8') ?></p>
    <p>Množstvo: <?= htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8') ?></p>
    <p>Celková cena pre typ produktu: <?= htmlspecialchars($totalPriceForThisItem, ENT_QUOTES, 'UTF-8') ?></p>
</div>

<?php endforeach; // End of the items loop ?>

<p>Celková cena: <?= $totalCartPrice ?></p>

<form action="order.php" method="post">
    <button type="submit">Objednať</button>
</form>

<?php else: // If there are no items in the cart ?>

<p>Váš košík je prázdny.</p>

<?php endif; // End of the items conditional ?>

<?php include 'footer.php';?>

</body>
</html>

<?php
$db->close();
?>
