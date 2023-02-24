<?php

	$name = 'Alexander Adam';
	$job = 'Web developer';
	$phone = '+421 950 793 593';
	$email = 'alex.adam12202@gmail.com';
	$adress = 'Slovensko';

?>
<!DOCTYPE html>
<html lang = "sk">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta name="description" content="Alexander Adam vizitka.">
<meta name="keywords" content="vizitka"> 
<meta name="author" content="Alexander Adam">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.typekit.net/owu3lgu.css">
<link rel="stylesheet" href="style.css">
	
<title>Moja vizitka</title>
</head>

<body>
		<div class="card"><br>
    	<div class="name"><?php echo $name; ?></div>
    	<div class="job-title"><?php echo $job ?></div><br><br>
    	<div class="phone"><?php echo $phone ?></div><br>
    	<div class="email"><?php echo $email ?></div><br>
		<div class="address"> <?php echo $adress ?> </div>
	</div>

</body>
</html>
    
