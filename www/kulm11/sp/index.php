<?php require_once "./ItemsDatabase.php" ?>
<?php
    $itemsDatabase = new ItemsDatabase();
    $items = $itemsDatabase->fetchAll();
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
        <h1>Store Trek</h1>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./signup.php">Sign up</a></li>
                <li><a href="./login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="items">
            <?php foreach($items as $item):?>
                <div class="item">
                    <h2><?php echo $item["name"];?></h2>
                    <p><strong><?php echo $item["price"];?></strong></p>
                    <p><?php echo $item["description"];?></p>
                    <img width="200" src="<?php echo $item["image"];?>">
                </div>
            <?php endforeach;?>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>