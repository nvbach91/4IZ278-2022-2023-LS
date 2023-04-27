<?php

require_once __DIR__ . '/../../classes/CategoriesDB.php';
require_once __DIR__ . '/../../classes/ProductsDB.php';

use classes\CategoriesDB;
use classes\ProductsDB;

$htmlTitle = 'HW Shop';

$CategoriesDB = new CategoriesDB();
$ProductsDB = new ProductsDB();

isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
if (isset($_GET['category'])) {
	$title = $CategoriesDB->getCategoryName($_GET['category']);
	$productsCount = $ProductsDB->countByCategory($_GET['category']);
	$products = $ProductsDB->fetchPageByCategory($_GET['category'], PRODUCTS_PAGE_SIZE, (($page - 1) * PRODUCTS_PAGE_SIZE));
	$paginationUrl = 'home?category=' . $_GET['category'] . '&page=';
} else {
	$title = 'All product\'s';
	$productsCount = $ProductsDB->countAll();
	$products = $ProductsDB->fetchPage(PRODUCTS_PAGE_SIZE, (($page - 1) * PRODUCTS_PAGE_SIZE));
	$paginationUrl = 'home?page=';
}

$pagesCount = ceil($productsCount / PRODUCTS_PAGE_SIZE);

if (!isset($_GET['category'])) require_once __DIR__ . '/slides.php';

?>
<h4 class="mb-4"><?php echo $title ?></h4>
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center mb-4">
	<?php foreach ($products as $product): ?>
		<div class="col mb-3">
			<div class="card h-100">
				<img class="card-img-top" src="<?php echo $product['img'] ?>" alt="Product image">
				<div class="card-body p-4">
					<div class="text-center">
						<h6 class="fw-bolder"><?php echo $product['name'] ?></h6>
						<?php echo formatPrice($product['price']) ?>
					</div>
				</div>
				<!-- Product actions-->
				<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
					<div class="text-center">
						<a href="addToCart?id=<?php echo $product['id_product'] ?>&flag=add"
						   class="btn btn-outline-dark mt-auto ms-2 me-2">Add to cart</a>
						<a href="addToCart?id=<?php echo $product['id_product'] ?>&flag=buy"
						   class="btn btn-outline-dark mt-auto ms-2 me-2">Buy</a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
<div class="text-center">
	<div class="pagination">
		<a href="<?php echo $paginationUrl . ($page == 1 ? 1 : ($page - 1)) ?>">&laquo;</a>
		<?php for ($p = 1; $p <= $pagesCount; $p++): ?>
			<a href="<?php echo $paginationUrl . $p ?>"
			   class="<?php echo $page == $p ? 'active' : '' ?>"><?php echo $p ?></a>
		<?php endfor; ?>
		<a href="<?php echo $paginationUrl . ($page == $pagesCount ? $page : ($page + 1)) ?>">&raquo;</a>
	</div>
</div>