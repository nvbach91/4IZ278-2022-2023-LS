<?php 
    require_once "db.php";
    session_start();
    $cart = [];
    $query = "SELECT good_id,name,price FROM cv09_goods WHERE good_id=:good_id";
    $stmt = $pdo->prepare($query);
    foreach ($_SESSION["cart"] as $good_id) {
        $stmt->execute(["good_id" => $good_id,]);
        $data = $stmt->fetch();
        array_push($cart, $data);
    }
    
    
?>
<?php require "header.php"?>

<body>
    <ul class="list-group">
        <?php foreach ($cart as $item) :?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $item["name"] ?>
                
                <span class="badge badge-primary badge-pill"><?php echo $item["price"] ?>$</span>
                <span ><a href="remove.php?good_id=<?php echo $item["good_id"] ?>">X</a></span>
            </li>
        <?php endforeach ?>
    </ul>
</body>

<?php require "footer.php"?>

