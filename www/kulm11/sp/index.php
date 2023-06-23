<?php require_once "./database/ItemsDatabase.php" ?>
<?php require_once "./database/UsersDatabase.php" ?>
<?php

session_start();
$itemsDatabase = new ItemsDatabase();
$usersDatabase = new UsersDatabase();

$totalItemAmounts = $itemsDatabase->getItemsAmount();
$itemsPerPage = 6;
$paginationCount = ceil($totalItemAmounts / $itemsPerPage);

if (!empty($_GET)) {
    $offset = htmlspecialchars($_GET["offset"]);
} else {
    $offset = 0;
}
$items = $itemsDatabase->fetchPage($itemsPerPage, $offset);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Store Trek</title>
</head>

<body>
    <header>
        <?php include "./includes/logo.php" ?>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <?php if(!isset($_COOKIE["username"])): ?>
                    <li><a href="./signup.php">Sign up</a></li>
                    <li><a href="./login.php">Login</a></li>
                <?php endif; ?>
                <?php if(isset($_COOKIE["username"])): ?>
                    <?php if($usersDatabase->isAdmin($_COOKIE["username"])): ?>
                        <li><a href="./admin.php">Admin</a></li>
                    <?php endif; ?>
                    <?php if(!$usersDatabase->isAdmin($_COOKIE["username"])): ?>
                        <?php if (isset($_SESSION["cart"])) {
                            $itemsNumber = count($_SESSION["cart"]);
                        } else {
                            $itemsNumber = 0;
                        }
                        ?>
                        <li><a href="./orderhistory.php">Order history</a></li>
                        <li><a href="./checkout.php">Checkout (<?php echo $itemsNumber;?>)</a></li>
                    <?php endif; ?>
                    <li><a href="./logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <div id="intro-image">
            <h1>Store Trek</h1>
            <h3>The best place for your Star Trek needs
            </h3>
        </div>
        <div id="homepage">
            <div id="items">
                <?php foreach ($items as $item) : ?>
                    <div class="item">
                        <a href="./product.php?id=<?php echo $item["itemid"];?>"><img height="200" src="<?php echo $item["image"]; ?>" alt="<?php echo $item["name"]; ?>"></a>
                        <h2><?php echo $item["name"]; ?></h2>
                        <p class="price-item">$<?php echo $item["price"]; ?></p>
                        <p class="description-item"><?php echo $item["description"]; ?></p>
                        <p><a href="./buy.php?item_id=<?php echo $item["itemid"]; ?>">Buy</a></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <ul id="homepage-pagination">
            <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
                <li>
                    <a href="<?php echo './index.php?offset=' . $i * $itemsPerPage . '#items'; ?>">
                        <?php echo $i + 1; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </main>
    <?php include "./includes/footer.php" ?>
</body>

</html>