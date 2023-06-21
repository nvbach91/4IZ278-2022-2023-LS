<?php 
session_start();

if (isset($_SESSION['cart_list'])) {
	echo '<a href="cart.php" class="cart-link"> '."Košík: " . count($_SESSION['cart_list']) . "</a>";
}

require_once "db.php";

if ( isset($_GET['id']) ) {
	$query = "SELECT * FROM zbozi WHERE id=" . $_GET['id'];

	$req = mysqli_query($connection, $query);
	$current_course = mysqli_fetch_assoc($req);


	if (empty($current_course)) {
		header("Location: 404.php");
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vzdělávací centrum</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 20px;
		}

		h1 {
			text-align: center;
		}

		p {
			text-align: justify;
		}

		.cart-link {
			display: block;
			text-align: center;
			margin-bottom: 20px;
			text-decoration: none;
			color: #333;
			font-weight: bold;
		}

		.course-details {
			max-width: 600px;
			margin: 0 auto;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 300px;
		}

		.course-details p {
			margin-bottom: 10px;
			line-height: 1.5;
		}

		.course-details strong {
			font-size: 18px;
		}

		.action-buttons {
			display: flex;
			justify-content: center;
			margin-top: 20px;
		}

		.action-buttons a {
			margin-right: 10px;
			padding: 10px 20px;
			background-color: #333;
			color: #fff;
			border-radius: 4px;
			text-decoration: none;
		}
	</style>
</head>

<body>

	<a href="index.php" class="cart-link">Home</a>

	<div class="course-details">
		<h1><?php echo $current_course['nazev'] ?></h1>

		<div>
			<p><?php echo $current_course['popis'] ?></p>

			<p><strong><?php echo $current_course['cena'] ?> CZK</strong></p>
		</div>

		<div class="action-buttons">
			<a href="order.php?title=<?php echo $current_course['nazev'] ?>" class="cart-link">Koupit 1 kliknutím</a>
			<a href="cart.php?course_id=<?php echo $current_course['id'] ?>" class="cart-link">Přidat do košíku</a>
		</div>
	</div>

</body>

</html>
