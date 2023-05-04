<?php
session_start();
require('./db/ProductsDB.php');
$productDatabase = new ProductsDB();
$ids = @$_SESSION['cart'];
$products = [];
if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';
    
    $stmt = $productDatabase->pdo->prepare("SELECT * FROM products WHERE product_id IN ($question_marks) ORDER BY name");
    $stmt->execute(array_values($ids));
    $products = $stmt->fetchAll();
    
    
    $stmt_sum = $productDatabase->pdo->prepare("SELECT SUM(price) FROM products WHERE product_id IN ($question_marks)");
    $stmt_sum->execute(array_values($ids));
    $sum = $stmt_sum->fetchColumn();
}
?>

<?php include './src/header.php' ?>
<main class="cartPage">
    <h1 class = 'cartTite'>My shopping cart</h1>
    Total goods selected: <?= count($products) ?>
    <br><br>
    <a class = 'continue' href="index.php">Continue shopping</a>
    <br><br>
    <?php if(@$products): ?>
    <div class="products">
        <?php foreach($products as $product): ?>
        <div class="items" style="width: calc(100% / 3)">
            <div class="cartItem">
                <h5 class="card-title"><?php echo $product['name'] ?></h5>
                <div class="card-subtitle"><?php echo $product['price'] ?>.00$</div>
                <form action="remove.php" method="POST">
                    <button type="submit" class="btn btn-danger">Remove</button>
                    <input class="d-none" name="id" value="<?php echo $product['product_id'] ?>" style = 'visibility: hidden'>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
        <h2 class = 'sum'>Total: <?php echo $sum;?>.00$ </h5>
    </div>
    <?php else: ?>
    <h5>No goods yet</h5>
    <?php endif; ?>
</main>