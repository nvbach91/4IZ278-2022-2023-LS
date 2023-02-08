<?php



$name = 'Homer Simpson';
$position = 'Manager of Nuclear Plant in Springfield';
$phone = '+420 123 456 789';
$email = 'homer@simpson.com';
$website = 'https://www.abc.com';



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="./main.css" rel="stylesheet">
</head>

<body>
	<h1>This is my business card</h1>
	<div class="business-card">
		<div class="bc-name"> <?php echo $name; ?></div>
		<div class="bc-position"><?php echo $position; ?></div>
		<div class="bc-phone">
			<a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
		</div>
		<div class="bc-email">
			<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
		</div>
		<div class="bc-website">
			<a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a>
		</div>
	</div>
</body>

</html>