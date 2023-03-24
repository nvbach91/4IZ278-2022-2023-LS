<?php
// pripojeni do db
require 'db.php';
// pristup jen pro prihlaseneho uzivatele
require 'user_required.php';
// http://php.net/manual/en/session.examples.basic.php
// Sessions can be started manually using the session_start() function. If the session.auto_start directive is set to 1, a session will automatically start on request startup.
// http://stackoverflow.com/questions/4649907/maximum-size-of-a-php-session
// You can store as much data as you like within in sessions. All sessions are stored on the server. The only limits you can reach is the maximum memory a script can consume at one time, which by default is 128MB.
//http://stackoverflow.com/questions/217420/ideal-php-session-size
// offset pro strankovani
if (isset($_GET['offset'])) {
    $offset = (int) $_GET['offset'];
} else {
    $offset = 0;
}
// celkovy pocet zbozi pro strankovani
$count = $db->query('SELECT COUNT(product_id) FROM cv11_products')->fetchColumn();
$stmt = $db->prepare('SELECT * FROM cv11_products ORDER BY product_id DESC LIMIT 10 OFFSET ?');
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();
?>




<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <h1>Products we've got</h1>
    <h2>Total products: <?php echo $count; ?></h2>
    <br>
    <br>
    <a href="new.php">New Product</a>
    <br>
    <br>
    <div class="pagination">
        <?php for ($i = 1; $i <= ceil($count / 10); ++$i): ?>
        <a class="<?php echo $offset / 10 + 1 == $i ? 'active' : ''; ?>" href="index.php?offset=<?php echo ($i - 1) * 10; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
    <br>
    <div class="products">
        <div class="product">
            <div></div>
            <div>Name</div>
            <div>Price</div>
            <div>Description</div>
            <div>Image URL</div>
            <div></div>
        </div>
        <?php foreach ($products as $product): ?>
        <div class="product">
            <div><a href="buy.php?product_id=<?php echo $product['product_id']; ?>">Buy</a></div>
            <div><?php echo $product['name']; ?></div>
            <div><?php echo $product['price']; ?></div>
            <div><?php echo $product['description']; ?></div>
            <div><?php echo substr($product['img'], 0, 50); ?>...</div>
            <div><a href="update.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></div>
            <div><a href="delete.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></div>
        </div>
        <?php endforeach; ?>
    </div>
</main>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>
