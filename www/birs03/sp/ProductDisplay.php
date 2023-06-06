<?php require_once 'ProductsDatabase.php';?>
<?php

$productsDatabase = new ProductsDatabase();

$itemsCountPerPage = 5;
$i;

if(!empty($_GET['offset'])){
    $offset = $_GET['offset'];
}else{
    $offset = 0;
}
//if(!empty($_GET['category_id'])){
if(isset($_GET['category_id'])&&!empty($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $totalRecords = $productsDatabase->getTotalRecortdsByCategory($category_id);
    $paginationCount = ceil($totalRecords/$itemsCountPerPage);
    $records = $productsDatabase->fetchRecordsByCategory($itemsCountPerPage,$offset,$category_id);
}else{
    $totalRecords = $productsDatabase->getTotalRecortds();
    $paginationCount = ceil($totalRecords/$itemsCountPerPage);
    $records = $productsDatabase->fetchRecords($itemsCountPerPage,$offset);
}
//<a style="text-decoration:none;<?php if($i == $_GET['offset']/$itemsCountPerPage){echo 'font-weight:bold;color:black';}?" 
//href="<?php if(isset($_GET['category_id'])){ echo __DIR__.'/index.php?category_id=' . $_GET['category_id'] . '&offset=' . $i *$itemsCountPerPage;}
        //else{echo __DIR__.'/index.php?category_id=0&offset=' . $i *$itemsCountPerPage;;}

?>
    <ul>
        <?php for($i=0;$i<$paginationCount;$i++): ?>
        <li style="display:inline;padding:5px 10px;margin-right:10px;" class="card"><a style="text-decoration:none;<?php if($i == $offset/$itemsCountPerPage){echo 'font-weight:bold;color:black';}?>" href="<?php if(isset($_GET['category_id'])){ echo 'index.php?category_id=' . $_GET['category_id'] . '&offset=' . $i *$itemsCountPerPage;}else{echo 'index.php?category_id=0&offset=' . $i *$itemsCountPerPage;;}?>">
            <?php echo $i + 1; ?>
        </a></li>
        <?php endfor;?>
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
                    <a href="buy.php?product_id=<?php echo $record['product_id'];?>">Buy</a>
                    <?php if(isset($_COOKIE['admin'])&&$_COOKIE['admin']==1){?>
                        <a href="editForm.php?product_id=<?php echo $record['product_id'];?>">Edit</a>
                        <a href="delete.php?product_id=<?php echo $record['product_id'];?>">Delete</a>
                    <?php ;}?>
                </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
