<?php

require_once __DIR__ . '/../../classes/CategoriesDB.php';
require_once __DIR__ . '/../../classes/ProductsDB.php';

use classes\CategoriesDB;
use classes\ProductsDB;

$htmlTitle = 'HW Shop | Products';
if (!isLoggedIn()) header('Location: home');

$categoriesDB = new CategoriesDB();

$productsDB = new ProductsDB();
$products = $productsDB->fetchAll();

?>
<div class="d-flex justify-content-end">
	<a class="mb-4" href="editProduct?id=&action=new" style="text-decoration: none">
		<button class="btn btn-outline-dark">
			<i class="bi bi-plus-circle-fill"></i>
			Add product
		</button>
	</a>
</div>
<div class="row animation fade-in">
	<table class="table">
		<thead>
		<tr>
			<th scope="col" style="width:60%;">Product name</th>
			<th scope="col" class="text-center" style="width:15%;">Category</th>
			<th scope="col" class="text-center" style="width:10%;">Unit price</th>
			<th scope="col" class="text-center" style="width:5%;">Image</th>
			<th scope="col" class="text-center" style="width:10%;">Actions</th>

		</tr>
		</thead>
		<tbody>
		<?php foreach ($products as $product): ?>
			<tr>
				<th scope="row"><?php echo $product['name']; ?></th>
				<td class="text-center"><?php echo $categoriesDB->getCategoryName($product['id_category']); ?></td>
				<td class="text-center"><?php echo formatPrice($product['price']); ?></td>
				<td class="text-center"><img src="<?php echo $product['img']; ?>" alt="Product image" class="img-products-list"></td>
				<td class="text-center">
					<a href="editProduct?id=<?php echo $product['id_product']; ?>&action=edit" class="text-black ms-2 me-2" style="text-decoration: none">
						<i class="bi bi-pen"></i>
					</a>
					<a href="deleteProduct?id=<?php echo $product['id_product']; ?>" class="text-black ms-2 me-2" style="text-decoration: none">
						<i class="bi bi-trash"></i>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>