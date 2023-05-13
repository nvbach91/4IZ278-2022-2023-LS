<?php require_once './ProductsDatabase.php';?>
<?php

$productsDatabase = new ProductsDatabase();

$itemsCountPerPage = 5;
$totalRecords = $productsDatabase->getTotalRecortds();
$paginationCount = ceil($totalRecords/$itemsCountPerPage);


if(!empty($_GET)){
    $offset = $_GET['offset'];
}else{
    $offset = 0;
}
$records = $productsDatabase->fetchRecords($itemsCountPerPage,$offset);


?>
    <ul>
        <?php for($i=0;$i<$paginationCount;$i++){ ?>
        <li style="display:inline;padding:5px 10px;margin-right:10px;" class="card"><a style="text-decoration:none;" href="<?php echo './index.php?offset=' . $i *$itemsCountPerPage;?>">
            <?php echo $i + 1; ?>
        </a></li>
        <?php }?>
    </ul>
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
                    <a href="./buy.php?good_id=<?php echo $record['good_id'];?>">Buy</a>
                    <a href="./editForm.php?good_id=<?php echo $record['good_id'];?>">Edit</a>
                    <a href="./delete.php?good_id=<?php echo $record['good_id'];?>">Delete</a>
                </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
