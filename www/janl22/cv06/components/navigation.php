<?php

require_once __DIR__ . '/../classes/CategoriesDB.php';

use classes\CategoriesDB;

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container px-4 px-lg-5">
		<a class="navbar-brand" href="index.php">HW Shop</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="index.php">All Categories</a></li>
						<li><hr class="dropdown-divider"></li>
						<?php foreach ($categories as $category): ?>
						<li><a class="dropdown-item" href="index.php?category=<?php echo $category['id_category']?>"><?php echo $category['name']?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>