<?php

require_once __DIR__ . '/../classes/CategoriesDB.php';

use classes\CategoriesDB;

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();


?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container px-4 px-lg-5">
		<a class="navbar-brand" href="<?php echo $GLOBALS['siteRoot'] ?>home">HW Shop</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
				class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
				<li class="nav-item"><a class="nav-link active" aria-current="page"
										href="<?php echo $GLOBALS['siteRoot'] ?>home">Home</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
					   aria-expanded="false">Categories</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="<?php echo $GLOBALS['siteRoot'] ?>home">All Categories</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<?php foreach ($categories as $category): ?>
							<li><a class="dropdown-item"
								   href="<?php echo $GLOBALS['siteRoot'] ?>home?category=<?php echo $category['id_category'] ?>"><?php echo $category['name'] ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
				<?php if (isLoggedIn()): ?>
					<li class="nav-item"><a class="nav-link" aria-current="page"
											href="<?php echo $GLOBALS['siteRoot'] ?>products">Edit products</a></li>
				<?php endif ?>
			</ul>
			<div class="d-flex">
				<a class="btn btn-outline-dark me-2" href="<?php echo $GLOBALS['siteRoot'] ?>cart" style="text-decoration: none">
					<i class="bi-cart-fill me-1"></i>
					Cart
					<span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo countItemsInCart(); ?></span>
				</a>
				<?php if (isLoggedIn()): ?>
					<div class="nav-item dropdown">
						<a class="btn btn-outline-dark" id="userDropdown" role="button" data-bs-toggle="dropdown"
						   aria-expanded="false"><i
								class="bi bi-person-fill me-1"></i><?php echo getUser()->name . ' ' . getUser()->surname ?>
						</a>
						<ul class="dropdown-menu" aria-labelledby="userDropdown">
							<li><a class="dropdown-item" href="<?php echo $GLOBALS['siteRoot'] ?>profile">Profile</a>
							</li>
							<li><a class="dropdown-item" href="<?php echo $GLOBALS['siteRoot'] ?>logout">Logout</a></li>
						</ul>
					</div>
				<?php else: ?>
					<a href="<?php echo $GLOBALS['siteRoot'] ?>login" class="btn btn-outline-dark" style="text-decoration: none">
						<i class="bi bi-box-arrow-in-right me-1"></i>
						Login
					</a>
				<?php endif ?>
			</div>
		</div>
	</div>
</nav>