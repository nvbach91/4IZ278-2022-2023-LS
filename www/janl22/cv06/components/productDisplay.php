<?php

require_once __DIR__ . '/../classes/CategoriesDB.php';
require_once __DIR__ . '/../classes/ProductsDB.php';

use classes\CategoriesDB;
use classes\ProductsDB;

$categoriesDB = new CategoriesDB();
$productsDB = new ProductsDB();

if(isset($_GET['category'])) {
	$title = $categoriesDB->getCategoryName($_GET['category']);
	$products = $productsDB->fetchByCategory($_GET['category']);
} else {
	$title = 'All product\'s';
	$products = $productsDB->fetchAll();
}

?>

<h4 class="mb-4"><?php echo $title ?></h4>
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
	<?php foreach ($products as $product): ?>
	<div class="col mb-5">
		<div class="card h-100">
			<img class="card-img-top" src="<?php echo $product['img'] ?>" alt="Product image">
			<div class="card-body p-4">
				<div class="text-center">
					<h5 class="fw-bolder"><?php echo $product['name'] ?></h5>
					<?php echo $product['price'] ?>
				</div>
			</div>
			<!-- Product actions-->
			<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
				<div class="text-center"><a class="btn btn-outline-dark mt-auto">Buy</a></div>
			</div>
		</div>
	</div>
	<?php endforeach ?>
</div>