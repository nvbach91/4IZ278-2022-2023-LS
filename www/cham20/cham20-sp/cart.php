<?php
require 'ProductsDatabase.php';
require 'UsersDatabase.php';
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "BASKET BEEBZZ", $buffer);
echo $buffer;


$productsDatabase = new ProductsDatabase();
$usersDatabase = new UsersDatabase();
$subtotal = 0;
$shipping = 5;

if (isset($_GET['increment'])) {
    $increment = $_GET['increment'];
    $product_id = $_GET['product_id'];
    if ($increment > 0) {
        $_SESSION['cart'][$product_id]['quantity']++;
        header("Location: cart.php");
    } else {
        if ($_SESSION['cart'][$product_id]['quantity'] > 1) {
            $_SESSION['cart'][$product_id]['quantity']--;
            header("Location: cart.php");
        }
        header("Location: cart.php");
    }
}
?>
<main>
    <div class="container cart-container">
        <div class="row">
            <div class="col-md-7 cart-items">
                <div class="row cart-legend">
                    <div class="col-sm-2 text-center">
                        <h4>Picture</h4>
                    </div>
                    <div class=" col-sm-2 text-center">
                        <h4>Name</h4>
                    </div>
                    <div class=" col-sm-2 text-center">
                        <h4>Price</h4>
                    </div>
                    <div class="col-sm-2">
                        <h4>Quantity</h4>
                    </div>
                </div>
                <?php if (isset($_SESSION['cart'])) :
                    $cart = $_SESSION['cart'];
                    foreach ($cart as $key => $value) : ?>
                        <div class="item row">
                            <?php $products = $productsDatabase->fetchByProductId($key); ?>
                            <?php foreach ($products as $product) : ?>
                                <div class="cart-img col-sm-2">
                                    <img src="<?php echo $product['picture']; ?>" alt="product picture">
                                </div>
                                <div class="cart-name col-sm-2 text-center">
                                    <?php echo $product['name']; ?>
                                </div>
                                <div class="cart-price col-sm-2 text-center">
                                    <?php echo $product['price']; ?>
                                </div>
                                <?php $subtotal += ($product['price'] * $value['quantity']); ?>
                            <?php endforeach; ?>
                            <div class="col-sm-2 text-center cart-quantity">
                                <a href="?increment=-1&product_id=<?php echo $key ?>"><i class="fa-solid fa-minus" style="color: #0a090d;"></i></a>
                                <?php echo " " . $value['quantity'] . " "; ?>
                                <a href="?increment=1&product_id=<?php echo $key ?>"><i class="fa-solid fa-plus" style="color: #0a090d;"></i></a>
                            </div>
                            <div class="col-sm-2">

                            </div>
                            <div class="col-sm-2 text-center cart-delete">
                                <a href="./delete_from_cart.php?product_id=<?php echo $key ?>"><i class="fa-solid fa-xmark" style="color: #0d090a;"></i></a>
                            </div>
                        </div>
                    <?php endforeach;
                else : ?>
                    <div class="alert alert-success">Your cart is empty.</div>
                <?php endif; ?>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4 cart-summary">
                <div>
                    <h4>Details</h4>
                </div>
                <div>
                    <?php
                    if (isset($_COOKIE['email'])) :
                        $email = $_COOKIE['email'];
                        $users = $usersDatabase->getUSer($email);
                        foreach ($users as $user) :
                    ?>
                            <p>Name: <b><?php echo $user['first_name'] . " " . $user['second_name']; ?></b></p>
                            <p>Email: <b><?php echo $user['email'] ?></b> , Phone: <b><?php echo $user['phone'] ?></b></p>
                            <?php
                            $adressesDatabase = new AdressesDatabase();
                            $adresses = $adressesDatabase->fetchById($user['adress_id']);
                            foreach ($adresses as $adress) :
                            ?>
                                <p>State: <b><?php echo $adress['country'] ?></b> , City: <b><?php echo $adress['city'] ?></b></p>
                                <p>Street: <b><?php echo $adress['street_plus_number'] ?></b></p>
                                <p>Postal: <b><?php echo $adress['postal_code'] ?></b></p>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                </div>
                <hr>
                <div>
                    <p>Subtotal: <b><?php echo $subtotal; ?>$</b></p>
                    <p>Shipping: <b><?php echo $shipping; ?>$</b> </p>
                    <p>Total: <b><?php echo ($shipping + $subtotal); ?>$</b></p>
                </div>
                <div class="cart-button">
                    <form action="./bought.php" method="POST">
                        <?php if (isset($_SESSION['cart'])) :
                            $cart = $_SESSION['cart'];
                            foreach ($cart as $key => $value) : ?>
                                <input type="text" name="my_array[]" value="<?= $key ?>" style="display: none;">
                                <input type="text" name="my_array_quantity[]" value="<?= $value['quantity'] ?>" style="display: none;">
                            <?php endforeach;
                        else : ?>
                            <div class="alert alert-success">Your cart is empty.</div>
                        <?php endif; ?>

                        <?php
                        if (isset($_COOKIE['email'])) :
                            $email = $_COOKIE['email'];
                            $users = $usersDatabase->getUSer($email);
                            foreach ($users as $user) :
                                $uid = $user['user_id'];
                        ?>
                                <input type="text" name="user_id" value="<?= $uid ?>" style="display: none;">
                        <?php endforeach;
                        endif; ?>
                        <button type="submit" class="btn btn-success">BUY NOW</button>
                    </form>
                </div>
            <?php else : ?>
                <div class="alert alert-success">For purchase you must be logged in.</div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>