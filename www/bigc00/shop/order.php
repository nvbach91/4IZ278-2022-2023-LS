<?php
session_start();
require_once 'db.php';
require_once 'styles.css';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vzdělávací centrum</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
<a href="index.php" class="cart-link">Home</a>

	<h1>Objednávka</h1>

	<form method="POST">

		<?php if (isset($_GET['nazev'])) : ?>
			<p>Objednáte si kurz: <?php echo $_GET['nazev']; ?></p>
		<?php elseif (isset($_SESSION['cart_list'])) : ?>
			<ul>
				<?php foreach ($_SESSION['cart_list'] as $course) : ?>

					<li><?php echo $course['nazev']; ?> | <?php echo $course['cena']; ?> CZK.</li>

				<?php endforeach; ?>
			</ul>

			<p>
				<a href="cart.php">Změnit objednávku</a>
			</p>
		<?php endif; ?>


		<input type="text" name="jmeno" placeholder="Jmeno">
		<input type="text" name="mobil" placeholder="Mobil">
		<input type="submit" value="Potvrďte objednávku">
	</form>

</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) > 0) {
		$name = $_POST['jmeno'];
		$mobile = $_POST['mobil'];

		// Generate a unique order ID
		$orderID = uniqid();

		foreach ($_SESSION['cart_list'] as $course) {
			$courseName = $course['nazev'];
			$coursePrice = $course['cena'];

			$query = "INSERT INTO objednavky (orderID, jmeno, cislo_mobilu, nazev_kurzu, cena_kurzu) VALUES ('$orderID','$name', '$mobile', '$courseName', $coursePrice)";

			if (mysqli_query($connection, $query)) {
				$message = "Order sent successfully!";
			} else {
				echo "Error sending order: " . mysqli_error($connection);
			}
		}
	} else {
		echo "No courses in the cart. Please" ?><a href="./index.php"> add courses </a>before submitting the order.
<?php
	}

	if (isset($message)) {
		echo $message;
	}
	unset($_SESSION['cart_list']);

}
mysqli_close($connection);
?>