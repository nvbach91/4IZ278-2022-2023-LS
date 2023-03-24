<?php

require 'db.php';
require 'user_required.php'; // pristup jen pro prihlaseneho uzivatele


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$products = [];
$ids = $_SESSION['cart'];

if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';

    $stmt = $db->prepare("SELECT * FROM cv11_products WHERE product_id IN ($question_marks) ORDER BY name");
    // array_values - vrati poled indexovane od 0, napr [42, 47, 63, 12, 44]
    $stmt->execute(array_values($ids));
    $products = $stmt->fetchAll();

    $stmt_sum = $db->prepare("SELECT SUM(price) FROM cv11_products WHERE product_id IN ($question_marks)");
    $stmt_sum->execute(array_values($ids));
    $sum = $stmt_sum->fetchColumn();
}

?>

<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <h1>My shopping cart</h1>
    Total products selected: <?php echo count($products); ?>
    <br><br>
    <a href="index.php">Back to the products</a>
    <br><br>
    <?php if ($products): ?>
        <div class="products">
            <div class="product">
                <div></div>
                <div>Name</div>
                <div>Price</div>
                <div>Description</div>
                <div>&nbsp;</div>
            </div>
            <?php foreach ($products as $product): ?>
            <div class="product">
                <div><a href='remove.php?product_id=<?php echo $product['product_id']; ?>'>Remove</a></div>
                <div><?php echo $product['name']; ?></div>
                <div><?php echo $product['price']; ?></div>
                <div><?php echo substr($product['description'], 0, 50) . '...'; ?></div>
                <div>&nbsp;</div>
            </div>
            <?php endforeach; ?>
        </div>
        <br>
        <div>Total: <strong><?php echo $sum; ?></strong></div>
    <?php else: ?>
        <div>No products yet</div>
    <?php endif; ?>
</main>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>
