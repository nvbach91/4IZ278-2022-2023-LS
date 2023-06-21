<?php
session_start();
require_once "db.php";
require_once "functions.php";



if (isset($_GET['delete_id']) && isset($_SESSION['cart_list'])) {
	foreach ($_SESSION['cart_list'] as $key => $value) {
		if ($value['id'] == $_GET['delete_id']) {
			unset($_SESSION['cart_list'][$key]);
		}
	}
}


if (isset($_GET['course_id']) && !empty($_GET['course_id'])) {

	$current_added_course = get_course_by_id($_GET['course_id']);

	// ...
	if (!empty($current_added_course)) {

		if (!isset($_SESSION['cart_list'])) {
			$_SESSION['cart_list'][] = $current_added_course;
		}


		$course_check = false;

		if (isset($_SESSION['cart_list'])) {
			foreach ($_SESSION['cart_list'] as $value) {
				if ($value['id'] == $current_added_course['id']) {
					$course_check = true;
				}
			}
		}


		if (!$course_check) {
			$_SESSION['cart_list'][] = $current_added_course;
		}
	} else {
		header("Location: 404.php");
	}
}

// var_dump($_SESSION);




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

		ul {
			list-style: none;
			padding: 0;
		}

		li {
			margin-bottom: 10px;
			text-align: center; 
			font-size: 18px; 
		}

		a {
			text-decoration: none;
			color: #333;
		}

		.cart-link {
			display: block;
			text-align: center;
			margin-bottom: 20px;
		}

		.empty-cart-message {
			text-align: center;
			font-weight: bold;
			font-size: 18px;
			margin-top: 20px;
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
		}
	</style>
</head>

<body>

	<a href="index.php" class="cart-link">Přejít na produkty</a>

	<h1>Košík</h1>

	<?php if (isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) != 0) : ?>

		<ul>
			<?php foreach ($_SESSION['cart_list'] as $course) : ?>

				<li>
					<?php echo $course['nazev']; ?> |
					<?php echo $course['cena']; ?> CZK. |
					<a href="cart.php?delete_id=<?php echo $course['id']; ?>">Х</a>
				</li>

			<?php endforeach; ?>
		</ul>

	<?php else : ?>

		<p class="empty-cart-message">
			Váš košík je prázdný
		</p>

	<?php endif; ?>


	<div class="action-buttons">
		<a href="index.php">Pokračovat v nákupu</a>
		<a href="order.php">Překontrolovat</a>
	</div>

</body>

</html>