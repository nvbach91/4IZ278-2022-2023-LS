<?php

    require_once(__DIR__."/db.php");
    $limitFrom = $_GET["limitFrom"] ?? 0;
    $limit = isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == "true" ? 5 : 6;

    if(empty($_GET["category"])) {

        $query = "SELECT COUNT(*) AS count FROM `product`";
        $numRecords = PDO->query($query)->fetchAll()[0]["count"];
        $numPages = ceil($numRecords/$limit);

        $query = "SELECT * FROM `product` LIMIT ?,?;";
        $stmt = PDO->prepare($query);
        $stmt->bindValue(1, $limitFrom, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll();
    } else {
        
        $query = "SELECT COUNT(*) AS count FROM `product` WHERE category_name=?";
        $numProducts = customFetch($query, [$_GET["category"] => PDO::PARAM_STR], false)["count"];
        // $stmt = PDO->prepare($query);
        // $stmt->bindValue(1, $_GET["category"], PDO::PARAM_STR);
        // $stmt->execute();
        // $numProducts = $stmt->fetch()["count"];

        $numPages = ceil($numProducts/$limit);

        $query = "SELECT * FROM `product` WHERE category_name=? LIMIT ?,?;";
        $stmt = PDO->prepare($query);
        $stmt->bindValue(2, $limitFrom, PDO::PARAM_INT);
        $stmt->bindValue(3, $limit, PDO::PARAM_INT);
        $stmt->bindValue(1, $_GET["category"], PDO::PARAM_STR);
        $stmt->execute();
        $products = $stmt->fetchAll();

    }

    $query = "SELECT * FROM `category`";
    $stmt = PDO->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll();

    if(array_key_exists("limitFrom", $_GET)){
        unset($_GET["limitFrom"]);
    }
    $params = http_build_query($_GET);
    
?>

<main>
    <div id="categories">
        <h2>Categories</h2>
        <div class="category">
            <a href="/www/mikd08/sp/index.php" class="category_link custom-link">All</a>
        </div>
        <?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == "true"):?>
            <div class="category">
                <span id="addCategory-btn" class="category_link custom-link">+ Add</span>
            </div>
        <?php endif ?>

        <?php foreach($categories as $category):?>
            <div class="category">
                <a href="/www/mikd08/sp/index.php?category=<?php echo htmlentities($category["category_name"]) ?>" class="category_link"><?php echo htmlentities($category["category_name"]) ?></a>
                <?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == "true"):?>
                <span style="display: none;">
                    <form action="/www/mikd08/sp/admin/deleteCategory.php" id="delete_category<?php echo htmlentities($category["category_name"]) ?>" method="POST">
                        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
                        <input type="text" name="category_name" value="<?php echo htmlentities($category["category_name"]) ?>" >
                    </form>
                </span>
                <button name="delete_category" form="delete_category<?php echo htmlentities($category["category_name"]) ?>">Delete</button>
                <?php endif ?>

            </div>
        <?php endforeach ?>

    </div>    
    <div style="display: flex; flex-wrap: wrap;">
    <?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == "true"):?> 
            <div id="addProduct-btn" class="card admin-card pointer" style="min-width: 200px; width: calc(33% - 40px); margin: 20px;">
                <div class="custom-link" style="text-align: center;">
                    <span class="material-symbols-outlined">add</span>
                    <div>
                        <h5 class="card-title">Add</h5>
                    </div>
                </div>
            </div>
    <?php endif ?>
    <?php foreach ($products as $product):?>
        <div class="card" style="min-width: 200px; width: calc(33% - 40px); margin: 20px;">
            <img class="card-img-top" src="<?php echo htmlentities($product["img"]); ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlentities($product["name"]); ?></h5>
                <p class="card-text"><?php echo htmlentities($product["price"]); ?>Kč</p>
            </div>
            <div class="card-body">
                <?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == "true"):?>
                    <button class="card-link editProduct-btn" name="<?php echo htmlentities($product["product_id"]) ?>">Edit</button>
                    <form action="/www/mikd08/sp/admin/deleteProduct.php" method="POST" id="delete_product<?php echo htmlentities($product["product_id"]) ?>" style="display:none;">
                        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">    
                        <input type="hidden" name="product_id" value="<?php echo htmlentities($product["product_id"]) ?>">
                        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
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
    </div>
</main>
        
<nav aria-label="...">
    <ul class="pagination">
        <?php for($i = 0; $i < $numPages; $i++){?>
            <li class="page-item"><a class="page-link" href="<?php echo "/www/mikd08/sp/index.php?limitFrom=".$i*$limit.(count($_GET) > 0 ? "&$params": "")?>"><?php echo $i + 1 ?></a></li>
        <?php }?>
    </ul>
</nav>