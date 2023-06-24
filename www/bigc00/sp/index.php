<?php
if (!isset($_SESSION)) {
	session_start();
}


if (isset($_SESSION['cart_list'])) {
	echo '<a href="cart.php" class="cart-link"> ' . "Košík: " . count($_SESSION['cart_list']) . "</a>";
}


require_once "db.php";

// Pagination configuration
$itemsPerPage = 3; // Number of items to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $itemsPerPage; // Offset for SQL query

// Fetch data from the database with pagination
$query = "SELECT * FROM courses LIMIT $offset, $itemsPerPage";
$req = mysqli_query($connection, $query);
$data_from_db = [];


while ($result = mysqli_fetch_assoc($req)) {
	$data_from_db[] = $result;
}

// Build the SQL query with category ID filtering
$query = "SELECT * FROM courses";
$categoryID = isset($_GET['category_id']) ? $_GET['category_id'] : null;
if (isset($categoryID)) {
	$query .= " WHERE category = '$categoryID'";
}
$query .= " LIMIT $offset, $itemsPerPage";

$req = mysqli_query($connection, $query);
$data_from_db = [];

while ($result = mysqli_fetch_assoc($req)) {
	$data_from_db[] = $result;
}

// Count total number of items for pagination
// Modify the count query based on the category ID
$countQuery = "SELECT COUNT(*) as total FROM courses";
if ($categoryID) {
	$countQuery .= " WHERE category = '$categoryID'";
}
$countResult = mysqli_query($connection, $countQuery);
$totalItems = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

$discountQuery = "SELECT COUNT(*) as discounted FROM courses WHERE discount>0";
$countResult = mysqli_query($connection, $discountQuery);
$discountedItems = mysqli_fetch_assoc($countResult)['discounted'];

$discountQuery = "SELECT * FROM courses WHERE discount>0";
$req = mysqli_query($connection, $discountQuery);
$data_from_db_discounted = [];

while ($result = mysqli_fetch_assoc($req)) {
	$data_from_db_discounted[] = $result;
}

?>

<body>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vzdělávací centrum</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<style>
		/* Add your custom styles here */
		.slider-container {
			position: relative;
			width: 200%;

			height: 400px;
			/* Adjust the height as per your requirement */
			overflow: hidden;
		}

		.slider {
			display: flex;
			width: 100%;
			height: 100%;
			animation: slide-animation 12s infinite;
		}

		.slider-item {
			flex: 0 0 <?php echo 100/$discountedItems.'%';?>;;
			padding: 20px;
			box-sizing: border-box;
		}

		.slider-item img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			border-radius: 8px;
		}

		@keyframes slide-animation {
			0% {
				margin-left: 0;
			}

			50.33% {
				margin-left: -50%;
			}


			100% {
				margin-left: -100%;
			}

		}
	</style>
</head>

<body>
	<a href="./admin.php" class="cart-link">Admin</a>
	<a href="./profile.php" class="cart-link">Profile</a>
	<h1>Vítejte v našem vzdělávacím centru!</h1>

	<!-- Slider for discounted courses -->
	<div class="slider-container">
		<div class="slider">
			<?php foreach ($data_from_db_discounted as $course_item) {
				$discount = $course_item['discount'];
				if ($discount > 0) : ?>
					<div class="slider-item">
						<h3><?php echo $course_item['title'] ?></h3>
						<a href="<?php echo 'single.php?id='. $course_item['id']?>">
						<img src="./imgs/<?php echo $course_item['id']?>.jpg " alt="<?php echo $course_item['title'] ?>">
						</a>
					</div>
			<?php endif;
			} ?>
		</div>
	</div>

	<!-- Buttons for category filtering -->
	<!-- Buttons for category filtering -->
	<div class="category-buttons">
		<a href="?category_id=IT" class="category-button <?php echo $categoryID === 'IT' ? 'active' : ''; ?>">IT</a>
		<a href="?category_id=Marketing" class="category-button <?php echo $categoryID === 'Marketing' ? 'active' : ''; ?>">Marketing</a>
		<a href="?" class="category-button <?php echo !$categoryID ? 'active' : ''; ?>">All</a>
	</div>

	<div id="center">

		<?php foreach ($data_from_db as $course_item) : ?>

			<div class="course_item">
				<img src="./imgs/<?php echo $course_item['id']?>.jpg" alt="<?php echo $course_item['title'] ?>"
				<h2>
					<?php echo $course_item['title'] ?>
				</h2>

				<p>
					<?php echo $course_item['description'] ?>
				</p>

				<p><strong>
						<?php if ($course_item['discount'] == 0) {
							echo $course_item['price'];
						} else echo 'Nová cena: ' . ($course_item['price'] * ((100 - $course_item['discount']) / 100)); ?> CZK
					</strong></p>

				<a href="single.php?id=<?php echo $course_item['id'] ?>">
					Více
				</a>

				<a href="cart.php?course_id=<?php echo $course_item['id'] ?>">
					Do košíku
				</a>
			</div>

		<?php endforeach; ?>

		<!-- Pagination links -->
	</div>
	<div class="pagination">
		<?php for ($i = 1; $i <= $totalPages; $i++) : ?>
			<a href=?<?php if (isset($categoryID)) echo 'category_id=' . $categoryID . '&' ?>page=<?php echo $i; ?>><?php echo $i; ?></a>
		<?php endfor; ?>
	</div>
	<script>
		// JavaScript code for slider animation
		const slider = document.querySelector('.slider');

		// Adjust the slide speed (in milliseconds) and the slide width accordingly
		const slideSpeed = 4000;
		const slideWidth = 50;

		// Calculate the slide distance based on the slide width
		const slideDistance = -slideWidth;

		// Calculate the total slide count dynamically
	 	let slideCount =2 ;

		// Adjust the slider width based on the slide count
		const sliderWidth = slideCount * 100 + '%';
		slider.style.width = sliderWidth;

		// Start the slider animation
		setInterval(() => {
			const marginLeft = parseInt(getComputedStyle(slider).marginLeft);
			const nextMarginLeft = marginLeft + slideDistance;
			slider.style.marginLeft = nextMarginLeft + '%';
		}, slideSpeed);
	</script>
</body>

</html>