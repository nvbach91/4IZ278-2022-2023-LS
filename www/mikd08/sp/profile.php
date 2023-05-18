<?php
    require_once "db.php";

    session_start();


    if (!empty($_POST)) {
        
        if (isset($_POST["current_password"])) {
            $current_password = $_POST["current_password"];
//TODO
            $stmt = $pdo->prepare('SELECT * FROM user WHERE user_id = :user_id LIMIT 1');
            $stmt->execute([
                'user_id' => $_SESSION["user_id"],
            ]);

            $existing_user = $stmt->fetchAll()[0];

            if (password_verify($current_password, $existing_user['password'])) {
                $new_password = $_POST["new_password"];
                $hashedNewPassword = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('UPDATE user SET password = :new_password WHERE user_id = :user_id');
                $stmt->execute([
                    'user_id' => $_SESSION["user_id"],
                    'new_password' => $hashedNewPassword,
                ]);
            } else {
                $_SESSION["error"] = "Error: Wrong password";
            }

        }

        if (isset($_POST["new_email"])) {
            $new_email = $_POST["new_email"];

            $stmt = $pdo->prepare('UPDATE user SET email = :new_email WHERE user_id = :user_id');
            $stmt->execute([
                'user_id' => $_SESSION["user_id"],
                'new_email' => $new_email,
            ]);


        }

    }

    $limitFrom = $_GET["limitFrom"] ?? 0;
    $limit = 10;

    $query = "SELECT COUNT(*) AS count FROM `order` WHERE user_id=?";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(1,$_SESSION["user_id"],PDO::PARAM_INT);
    $stmt->execute();
    $numRecords = $stmt->fetchAll()[0]["count"];
    $numPages = ceil($numRecords/$limit);
 
    $query = "SELECT * FROM `order` LIMIT ?,?;";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(1, $limitFrom, PDO::PARAM_INT);
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $orders = $stmt->fetchAll();


    $stmt = $pdo->prepare('SELECT * FROM user WHERE user_id = ? LIMIT 1');
    $stmt->bindValue(1,$_SESSION["user_id"],PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "head.php";?>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <?php require_once "nav.php";?>
    <?php if(isset($_SESSION["error"])):?> 
            <h2 style="color:red;"><?php echo $_SESSION["error"]; unset($_SESSION["error"]);?></h2>
    <?php endif ?>
    <h1>User info</h1>
    <div><span class="user_data">Username: <?php echo $user["username"];?></span></div>
    <div>
        <span class="user_data">Password:</span> 
        <form action="profile.php" method="post" style="display: inline-block">
            <input type="password" name="current password" autocomplete="off" placeholder="current password" required>
            <input type="password" name="new password" autocomplete="off" placeholder="new password" required>
            <button type="submit" name="submit">
                Change password
            </button>
        </form>
    </div>
    <div><span class="user_data">Name: <?php echo $user["name"];?></span></div>
    <div>
        <span class="user_data">
            E-mail: <?php echo $user["email"];?>
        </span>
        <form action="profile.php" method="post" style="display: inline-block">
            <input type="email" name="new email" placeholder="new email" required>
            <button type="submit" name="submit">
                Change email
            </button>
        </form>
    </div>

    <div><span class="user_data">Phone: <?php echo $user["phone"];?></span></div>
    <div><span class="user_data">Address: <?php echo $user["address"];?></span></div>
    <hr>
    <div>
        <h1>Orders</h1>
        <div id="orders">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Price</th>
                        <th>Payment method</th>
                        <th>order date</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach($orders as $order):?>
                <tr>
                    <td><a class="orderDetails-btn" href="orderDetails.php?order_id=<?php echo htmlentities($order["order_id"]); ?>"><?php echo htmlentities($order["order_id"]); ?></a></td>
                    <td><?php echo htmlentities($order["price"]); ?></td>
                    <td><?php echo htmlentities($order["payment_method"]); ?></td>
                    <td><?php echo htmlentities(date("d.m.Y H:i:s", strtotime($order["date"]))); ?></td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="...">
            <ul class="pagination">
                <?php for($i = 0; $i < $numPages; $i++){?>
                    <li class="page-item"><a class="page-link" href="<?php echo "profile.php?limitFrom=".$i*$limit?>"><?php echo $i + 1 ?></a></li>
                <?php }?>
            </ul>
        </nav>
    </div>
    <div id="orderDetails" class="overlay">
        <div>
            <h1></h1>
            <h3></h3>
            <table>
                <thead>
                    <tr>
                        <th>Product name</th>
                        <th>price per unit</th>
                        <th>amount</th>
                        <th>price</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div id="total"></div>
        </div>
    </div>
</body>
</html>
