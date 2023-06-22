<?php require_once "./database/ItemsDatabase.php" ?>
<?php require_once "./database/UsersDatabase.php" ?>
<?php require_once "./database/CategoriesDatabase.php" ?>
<?php

session_start();
$itemsDatabase = new ItemsDatabase();
$usersDatabase = new UsersDatabase();
$categoryDatabase = new CategoriesDatabase();

if(!isset($_GET["id"]) || !$itemsDatabase->containsItem($_GET["id"])){
    header("Location: ./index.php");
    exit;
}

$item = $itemsDatabase->fetch($_GET["id"]);

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
        <div id="itemPage">
            <h2><?php echo $item["name"];?></h2>
            <div id="itemPageContent">
                <img height="300" src="<?php echo $item["image"]; ?>" alt="<?php echo $item["name"]; ?>">
                <div id="itemPageInfo">
                    <p><strong>Category</strong>: <?php echo $categoryDatabase->fetch($item["category_categoryid"])["name"];?></p>
                    <p><strong>Price</strong>: $<?php echo $item["price"];?></p>
                    <p><br\><?php echo $item["description"];?></p>
                </div>
            </div>
        </div>
    </main>
    <?php include "./includes/footer.php" ?>
</body>

</html>