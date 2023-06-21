<?php

session_start();

if (isset($_SESSION['cart_list'])) {
	echo '<a href="cart.php" class="cart-link"> '."Košík: " . count($_SESSION['cart_list']) . "</a>";
}


require_once "db.php";


// Pagination configuration
$itemsPerPage = 3; // Number of items to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $itemsPerPage; // Offset for SQL query

// Fetch data from the database with pagination
$query = "SELECT * FROM zbozi LIMIT $offset, $itemsPerPage";
$req = mysqli_query($connection, $query);
$data_from_db = [];


while ($result = mysqli_fetch_assoc($req)) {
	$data_from_db[] = $result;
}

// Build the SQL query with category ID filtering
$query = "SELECT * FROM zbozi";
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
$countQuery = "SELECT COUNT(*) as total FROM zbozi";
if ($categoryID) {
    $countQuery .= " WHERE category = '$categoryID'";
}
$countResult = mysqli_query($connection, $countQuery);
$totalItems = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalItems / $itemsPerPage);



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
</head>
<body>
<a href="./admin.php" class="cart-link">Admin</a>
<a href="./registration.php" class="cart-link">Register</a>
	<h1>Vítejte v našem vzdělávacím centru!</h1>

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
				<h2>
					<?php echo $course_item['nazev'] ?>
				</h2>

				<p>
					<?php echo $course_item['popis'] ?>
				</p>

				<p><strong>
						<?php if ($course_item['akce'] == null) {
							echo $course_item['cena'];
						} else echo 'Nová cena: ' . ($course_item['cena'] * ((100 - $course_item['akce']) / 100)); ?> CZK
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
			<a href=?<?php if(isset($categoryID))echo'category_id='. $categoryID.'&' ?>page=<?php echo $i; ?>><?php echo $i; ?></a>
		<?php endfor; ?>
	</div>

</body>

</html>