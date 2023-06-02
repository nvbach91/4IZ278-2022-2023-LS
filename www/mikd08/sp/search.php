<?php 
var_dump($_GET);
require_once "db.php";

$limitFrom = $_GET["limitFrom"] ?? 0;
$limit = isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == "true" ? 5 : 6;

if (!empty($_GET["searchReq"])) {
    $searchReq = $_GET["searchReq"];
    $query = "SELECT COUNT(*) AS count FROM `product` WHERE name LIKE '%?%' AND active=1";
    $numRecords = PDO->query($query)->fetchAll()[0]["count"];
    var_dump($numRecords);
    $numPages = ceil($numRecords/$limit);

    $products = customFetch("SELECT * FROM `product` WHERE name LIKE CONCAT('%', ?, '%') AND active=1 LIMIT ?,?",[$searchReq => PDO::PARAM_STR, $limitFrom => PDO::PARAM_INT, $limit => PDO::PARAM_INT]);
    var_dump($products);
} 
?>

<?php foreach ($products as $product):?>
        <div class="card" style="min-width: 200px; width: calc(33% - 40px); margin: 20px;">
            <img class="card-img-top" src="<?php echo htmlentities($product["img"]); ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlentities($product["name"]); ?></h5>
                <p class="card-text"><?php echo htmlentities(number_format($product["price"],2,","," ")); ?>Kč</p>
            </div>
            <div class="card-body">
                <?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == "true"):?>
                    <button class="card-link editProduct-btn" name="<?php echo htmlentities($product["product_id"]) ?>">Edit</button>
                    <form action="/www/mikd08/sp/admin/deleteProduct.php" method="POST" id="delete_product<?php echo htmlentities($product["product_id"]) ?>" style="display:none;">
                        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">    
                        <input type="hidden" name="product_id" value="<?php echo htmlentities($product["product_id"]) ?>">
                    </form>
                    <button name="delete_product" form="delete_product<?php echo htmlentities($product["product_id"]) ?>" class="card-link">Delete</button>              
                <?php  else:?>
                    <?php if(empty($_SESSION["user_id"])): ?>
                        <span class="card-link custom-link" id="buy-btn">Log in</span>
                    <?php  else:?>
                        <a href="/www/mikd08/sp/customer/buy.php?product_id=<?php echo htmlentities($product["product_id"])?>" class="card-link addToCart-link" id="buy-btn">Add to cart</a>
                    <?php  endif?>
                <?php  endif?>
            </div>
        </div>
    <?php endforeach?>