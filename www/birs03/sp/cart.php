<?php require_once './ProductsDatabase.php';?>
<?php
session_start();
$productsDatabase = new ProductsDatabase();
$records=[];
if(!empty($_SESSION['selected_product'])){
    $records = $productsDatabase->getRecortdsById($_SESSION['selected_product']);
}

    
?>
<?php require './header.php'; ?>
        <section style="height:100%" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1>Cart</h1>
            <div><a href="./index.php">Back</a></div>
            
            <div class="row">
                <?php foreach($records as $record):?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 product">
                        <a href="#">
                            <img class="card-img-top product-image" src="<?php echo $record['img'];?>" alt="product-image">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                            <a style="text-decoration:none" href="#"><?php echo $record['name']; ?></a>
                            </h4>
                            <h5><?php echo number_format($record['price'], 2), ' €'; ?></h5>
                            <p class="card-text"><?php echo $record['description'];?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            <a href="./remove.php?good_id=<?php echo $record['good_id'];?>">Remove</a>
                        </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            </div>
        </section>
<?php require './footer.php'; ?>