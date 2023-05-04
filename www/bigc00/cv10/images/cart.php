<?php
session_start();
require './db/Database.php';
$db = new Database();
$ids = @$_SESSION['cart'];
$goods = [];
if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';
    
    $stmt = $db->pdo->prepare("SELECT * FROM cv06_products WHERE product_id IN ($question_marks) ORDER BY name");
    $stmt->execute(array_values($ids));
    $goods = $stmt->fetchAll();
    
    
    $stmt_sum = $db->pdo->prepare("SELECT SUM(price) FROM cv06_products WHERE product_id IN ($question_marks)");
    $stmt_sum->execute(array_values($ids));
    $sum = $stmt_sum->fetchColumn();
}
?>



<main class="container">
    <h1>My shopping cart</h1>
    Total goods selected: <?= count($goods) ?>
    <br><br>
    <a href="./index.php">Back to the avocados!</a>
    <br><br>
    <?php if(@$goods): ?>
    <div class="products">
        <?php foreach($goods as $good): ?>
        <div class="card product" style="width: calc(100% / 3)">
            <img class="card-img-top" src="https://via.placeholder.com/300x150" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $good['name'] ?></h5>
                <div class="card-subtitle"><?php echo $good['price'] ?></div>
                <form action="removeItem.php" method="POST">
                    <input class="d-none" name="id" value="<?php echo $good['product_id'] ?>" style = "visibility: hidden">
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <h5>No goods yet</h5>
    <?php endif; ?>
</main>