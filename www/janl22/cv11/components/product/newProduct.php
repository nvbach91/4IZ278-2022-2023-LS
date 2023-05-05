<?php

require_once __DIR__ . '/../../classes/StatusMessage.php';
require_once __DIR__ . '/../../classes/CategoriesDB.php';
require_once __DIR__ . '/../../classes/ProductsDB.php';

use classes\CategoriesDB;
use classes\ProductsDB;
use classes\StatusMessage;

$htmlTitle = 'HW Shop | Products | New';
if (!hasPermission('store.manager')) {
	require_once __DIR__ . '/../../templates/403.php';
	exit();
}

$CategoriesDB = new CategoriesDB();
$categories = $CategoriesDB->fetchAll();

$ProductsDB = new ProductsDB();

$formSubmitted = !empty($_POST);
$fieldStatuses = [];

if ($formSubmitted) {

	$productName = trim($_POST['productName']);
	$category = trim($_POST['category']);
	$price = trim($_POST['price']);
	$image = trim($_POST['image']);

	if (empty($productName)) $fieldStatuses['productName'] = new statusMessage('Please enter product name!', 'error');
	if (!is_numeric($category)) $fieldStatuses['category'] = new statusMessage('Please select valid category!', 'error');
	if (!is_numeric($price)) $fieldStatuses['price'] = new statusMessage('Please enter valid price!', 'error');
	if (!filter_var($image, FILTER_VALIDATE_URL)) {
		$fieldStatuses['image'] = new statusMessage('Please enter valid product image URL address!', 'error');
	} else {
		$image_type_check = @exif_imagetype($image);
		if (!strpos($http_response_header[0], "200")) {
			$fieldStatuses['avatar'] = new statusMessage('Entered URL address does not contain valid product image!', 'error');
		}
	}

	if (empty($fieldStatuses)) {

		$product = ['category' => intval($category), 'name' => $productName, 'price' => $price, 'image' => $image];

		$response = $ProductsDB->newProduct($product);
		if ($response['status'] == 200) {
			Header('Location: products');
		} else {
			$fieldStatuses['newProduct'] = $response['message'];
		}

	}

}

?>

<div class="d-flex justify-content-center align-items-center">
	<div class="container mt-4 mb-4">
		<div class="row animation fade-in">
			<div class="col-xl-3"></div>
			<div class="card col-xl-6">
				<div class="card-body">
					<h1 class="text-center mt-4">Add product</h1>
					<div class="mt-4 w-full justify-content-center">
						<form id="productEdit" method="POST"
							  action="<?php echo $GLOBALS['request']; ?>">
							<?php if ($formSubmitted): ?>
								<div class="mb-4">
									<?php foreach ($fieldStatuses as $fieldStatus): ?>
										<div class="alert alert-<?php echo $fieldStatus->type ?> mt-2 mb-2"
											 role="alert"><?php echo $fieldStatus->message ?></div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<div class="form-outline mb-4">
								<input type="text" id="productName" name="productName"
									   class="form-control <?php echo isset($fieldStatuses['productName']) ? 'is-invalid' : '' ?>"
									   placeholder="NVIDIA GeForce RTX 4090"
									   value="<?php echo $productName ?? '' ?>"
									   tabindex="1">
								<label class="form-label" for="productName">Product name *</label>
							</div>

							<div class="mb-4">
								<select id="category" name="category"
										class="select <?php echo isset($fieldStatuses['category']) ? 'is-invalid' : '' ?>"
										tabindex="2">
									<option value="" selected>Please select category</option>
									<?php foreach ($categories as $categorySelect): ?>
										<option
											value="<?php echo $categorySelect['id_category'] ?>" <?php echo $category == $categorySelect['id_category'] ? 'selected' : '' ?>><?php echo $categorySelect['name'] ?></option>
									<?php endforeach; ?>
								</select>
								<label for="category" class="form-label select-label">Category *</label>
							</div>

							<div class="form-outline mb-4">
								<input type="number" id="price" name="price"
									   class="form-control <?php echo isset($fieldStatuses['pass']) ? 'is-invalid' : '' ?>"
									   value="<?php echo $price ?? '' ?>" tabindex="3">
								<label class="form-label" for="price">Price *</label>
							</div>

							<div class="form-outline mb-4">
								<input type="text" id="image" name="image"
									   class="form-control <?php echo isset($fieldStatuses['pass']) ? 'is-invalid' : '' ?>"
									   value="<?php echo $image ?? '' ?>" tabindex="4">
								<label class="form-label" for="image">Image link *</label>
							</div>

							<button type="submit" class="btn btn-primary btn-block mb-4" tabindex="5">
								Add product
							</button>

						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>