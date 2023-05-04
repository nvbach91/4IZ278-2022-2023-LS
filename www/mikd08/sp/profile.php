<?php
    require_once "db.php";

    session_start();

    $limitFrom = $_GET["limitFrom"] ?? 0;
    $limit = 10;

    $query = "SELECT COUNT(*) AS count FROM `order`";
    $numRecords = $pdo->query($query)->fetchAll()[0]["count"];
    $numPages = ceil($numRecords/$limit);
 
    $query = "SELECT * FROM `order` LIMIT ?,?;";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(1, $limitFrom, PDO::PARAM_INT);
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $orders = $stmt->fetchAll();


    $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username LIMIT 1'); //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'username' => $_SESSION["username"],
    ]);
    $user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "head.php";?>
</head>
<body>
    <?php require_once "nav.php";?>
    <h1>User info</h1>
    <div><span class="user_data">Username:</span> <?php echo $user["username"];?></div>
    <div><span class="user_data">Password:</span> Change password</div>
    <div><span class="user_data">Name:</span> <?php echo $user["name"];?></div>
    <div><span class="user_data">E-mail:</span> <?php echo $user["email"];?></div>
    <div><span class="user_data">Phone:</span> <?php echo $user["phone"];?></div>
    <div><span class="user_data">Address:</span> <?php echo $user["address"];?></div>
    <hr>
    <div>
        <h1>Orders</h1>
        <div class="orders">
            <?php foreach($orders as $order):?>
                <div>
                    <span><?php echo htmlentities($order["order_id"]); ?></span>
                    <span><?php echo htmlentities($order["price"]); ?></span>
                    <span><?php echo htmlentities($order["payment_method"]); ?></span>
                    <span><?php echo htmlentities($order["date"]); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <nav aria-label="...">
            <ul class="pagination">
                <?php for($i = 0; $i < $numPages; $i++){?>
                    <li class="page-item"><a class="page-link" href="<?php echo "profile.php?limitFrom=".$i*$limit?>"><?php echo $i + 1 ?></a></li>
                <?php }?>
            </ul>
        </nav>
    </div>
</body>
</html>