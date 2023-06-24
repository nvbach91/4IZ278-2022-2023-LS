<?php
session_start();
$message = '';

if (isset($_SESSION['cart_list'])) {
	echo '<a href="cart.php" class="cart-link"> ' . "Košík: " . count($_SESSION['cart_list']) . "</a>";
}

require_once "db.php";

if (isset($_GET['id'])) {
	$query = "SELECT * FROM courses WHERE id=" . $_GET['id'];

	$req = mysqli_query($connection, $query);
	$current_course = mysqli_fetch_assoc($req);


	if (empty($current_course)) {
		header("Location: 404.php");
	}
}

if (isset($_POST['update_zbozi'])) {
	$id = $_POST['id'];
	$nazev = $_POST['title'];
	$popis = $_POST['description'];
	$cena = $_POST['price'];
	$akce = $_POST['discount'];
	$categoryName = $_POST['category'];
	if ($akce <= 0) {
		$akce = 0;
	}
	$query = "UPDATE courses SET title = '$nazev', description = '$popis', price = $cena, discount = $akce, `category` = '$categoryName' WHERE id = $id";
	if (mysqli_query($connection, $query)) {
		$message = "Zboží úspěšně aktualizováno!";
		header("Location: " . $_SERVER['PHP_SELF'].'?id='.$id);
		exit();
	} else {
		echo "Error updating zbozi: " . mysqli_error($connection);
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
			margin-top: 0;
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
			padding: 20px;
			background-color: #f5f5f5;
			border-radius: 8px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

		.action-buttons input[type="submit"] {
			padding: 10px 20px;
			background-color: #333;
			color: #fff;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
		}

		.action-buttons input[type="text"] {
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
			font-size: 20px;
		}

		.action-buttons input[type="text"]:focus {
			outline: none;
			border-color: #666;
		}

		.course-admin,
		.course-details input[type="text"] {
			padding: 8px;
		
			border-radius: 4px;
			font-size: 20px;
		}

		.course-admin,
		.course-details input[type="text"]:focus {
			outline: none;
			border-color: #666;
		}
		.course-details img {
			width: 100%;
			height: auto;
		}
	</style>
</head>

<body>

	<a href="index.php" class="cart-link">Home</a>

	<div class="course-details">
	<img src="./imgs/<?php echo $current_course['id']?>.jpg " alt="<?php echo $current_course['title'] ?>">
		<h1><?php
			echo $message;

			if ((isset($_SESSION['admin']) && $_SESSION['admin'] == true )) {
				echo '<form method="POST" ><input type="text" name="title" value="' . $current_course['title'] . '">';
			} else echo $current_course['title'] ?></h1>

		<div class="course-admin">
			<?php if ((isset($_SESSION['admin']) && $_SESSION['admin'] == true)) : ?>
				<p><input type="text" name="description" value="<?php echo $current_course['description'] ?>">
					description</p>
				<p><strong><input type="text" name="price" value="<?php echo $current_course['price']; ?>">
						CZK</strong></p>
				<p><strong><input type="text" name="discount" value="<?php echo $current_course['discount'] ?>">
						%</strong></p>
				<p><strong><input type="text" name="category" value="<?php echo $current_course['category'] ?>">
						category</strong></p>
			<?php endif ?>

			<?php if (((!isset($_SESSION['admin']) || $_SESSION['admin'] != true))) {
				echo '<p><strong>' . $current_course['description'] . '</strong></p>';
				echo '<p><strong>' .'Cena: '. $current_course['price'] . 'CZK' . '</strong></p>';
			} ?>
		</div>

		<div class="action-buttons">
			<?php if ((isset($_SESSION['admin']) && $_SESSION['admin'] == true)) {

				echo '<input type="hidden" name="id" value="' . $current_course['id'] . '"><input type="submit" name="update_zbozi" value="Update">';
			}

			?>
			<a href="order.php?title=<?php echo $current_course['title'] ?>" class="cart-link">Koupit 1 kliknutím</a>
			<a href="cart.php?course_id=<?php echo $current_course['id'] ?>" class="cart-link">Přidat do košíku</a>
		</div>
	</div>

</body>

</html>