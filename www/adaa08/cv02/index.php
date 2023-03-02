<?php

require_once 'person.php';
require_once 'utils.php';

$person1 = new Person(
	'Alexander',
	'Adam',
	'Web',
	'auditor',
	'+421 950 793 593',
	'alex.adam12202@example.com',
	'Banska Bystrica',
	'Slovensko',
	'2002'
);

$person2 = new Person(
	'Jakub',
	'Frank',
	'Web',
	'developer',
	'+421 999 999 999',
	'jakub.frank@example.com',
	'Bratislava',
	'Slovensko',
	'1999'
);

$person3 = new Person(
	'Matej',
	'Havlicek',
	'Web',
	'designer',
	'+420 999 999 999',
	'matej.havlicek@example.com',
	'Praha',
	'Cesko',
	'1998'
);

$people = [$person1, $person2, $person3];

?>
<!DOCTYPE html>
<html lang = "sk">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta name="description" content="Vizitky firmy Smart Webs.">
<meta name="keywords" content="vizitky"> 
<meta name="author" content="Alexander Adam">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.typekit.net/owu3lgu.css">
<link rel="stylesheet" href="style.css">
	
<title>Vizitky</title>
</head>

<body>

	<main>
		<?php foreach($people as $person): ?>
		<div class="card"><br>
		<div class="name"><?php echo $person->getFullName(); ?></div>
    	<div class="job-title"><?php echo $person->getJob(); ?></div><br><br>
    	<div class="phone"><?php echo $person->phone; ?></div><br>
		<div class="birthday"> <?php echo calculateAge($person->birthYear); ?></div><br>
    	<div class="email"><?php echo $person->email; ?></div><br>
		<div class="address"><?php echo $person->getAdress(); ?></div>
		</div>
		<?php endforeach; ?>
	</main>

</body>
</html>