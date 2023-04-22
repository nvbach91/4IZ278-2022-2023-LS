<?php require_once __DIR__ . '/db/ProductsDB.php'; ?>

<?php define('GLOBAL_CURRENCY', 'EUR'); ?>

<?php
$productsDB = new ProductsDB();

// Fetch all categories and products
$categories = $productsDB->fetchAllCategories();

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
if ($category_id !== null) {
    $products = $productsDB->fetchByCategory($category_id);
} else {
    $products = $productsDB->fetchAll();
}

// Fetch slides data
$slides = $productsDB->fetchSlides();
?>

 



<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
   
    <?php foreach ($slides as $index => $slide){?>

    <div class="carousel-item <?php echo $index == 0? 'active':''; ?> ">
      <img class="d-block w-100" style="height:600px" src="<?php echo $slide['img']; ?>" alt="Second slide">
      <div class="text-center">
                <?php echo $slide['title']; ?>
            </div>
    </div>
    <?php }?>
  
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next text-danger" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon " aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


 
<br>


<div class="categories">
    <h3>Kategorie</h3>
    <?php foreach ($categories as $category): ?>
        <a href="https://esotemp.vse.cz/~adaa08/cv06/index.php?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
    <?php endforeach; ?>
</div>


<div class="row">
    <?php foreach ($products as $product): ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 product">
                <a href="#">
                    <img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="mango-product-image">
                </a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">
                            <?php echo $product['name']; ?>
                        </a>
                    </h4>
                    <h5>
                        <?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?>
                    </h5>
                    <p class="card-text">...</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>