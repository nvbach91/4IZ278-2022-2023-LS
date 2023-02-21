<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CV01 - Busincess card</title>
	<style>
		* {
			box-sizing: border-box;
			margin: 0;
		}
		.bc {
			display: inline-block;
			padding: 25px;
			border-radius: 4px;
			border: 1px solid rgba(0, 0, 0, 0.1);
			background-image: url("https://www.tilingtextures.com/wp-content/uploads/2019/05/0090b-768x768.jpg");
			background-position: center center;
			background-size: cover;
		}

		.bc__header {
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		.bc__header .logo {
			height: 30px;
		}

		.bc__header .logo img {
			height: 100%;
		}

		.bc__body {
			margin: 40px 70px 40px;
			text-align: center;
		}

		.bc__body h2 {
			font-size: 20px;
			font-weight: 300;
			margin-bottom: 10px;
		}

		.bc__body h4 {
			font-weight: 300;
		}

		.bc__footer {
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
		$logo = "https://pr.vse.cz/wp-content/uploads/page/58/VSE_logo_CZ_horizontal_black.png";
		$name = "Konstantin PANKRATOV";
		$phone = "+420 736 530 403";
		$bday = new DateTime('25.08.1998');
		$age = $bday->diff(new DateTime('now'))->y;
		$status = "VŠE student, $age let";
		$address = "Slavojova 499/20, Praha 2, 12800";
	?>
	<div class="bc">
		<div class="bc__header">
			<div class="logo">
				<img src="<?php echo $logo; ?>" alt="vse">
			</div>
			<div class="phone">
				<?php echo $phone; ?>
			</div>
		</div>
		<div class="bc__body">
			<h2><?php echo $name; ?></h2>
			<h4><?php echo $status; ?></h4>
		</div>
		<div class="bc__footer">
			<?php echo $address; ?>
		</div>
	</div>
</body>
</html>