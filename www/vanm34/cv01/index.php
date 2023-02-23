<?php 
$fName = "Martin";
$lName = "Váňa";
$age = 25;
$position = "Code Monkey";
$company = "MonkeyLand";
$street = "Falešná";
$LandRegistryNumber = 888;
$HouseNumber = 123;
$City = "Prague";
$phoneNumber = "777 888 999";
$email = "mv@email.com";
$webPage = "Page.com";
$job = true;

if ($job==true) {
    $status = "Please hire me :(";
  } else {
    $status = "Too good for you";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Business Card</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="card">
        <div class = "avatar"></div>
        <div class = "content">
            <div class="FirstName"><?php echo $fName ?></div>
            <div class="LastName"><?php echo $lName ?></div>
            <div class="text"><?php echo $position ?></div>
            
            <div class="contact">Age: <?php echo $age ?></div>
            <div class="contact"><?php echo $phoneNumber ?></div>
            <div class="contact"> Email: <a class="email"><?php echo $email ?></a></div>
        </div>    
    </div>
    <div class="cardBack">
        <div class="companyName"><?php echo $company ?></div>
        <div class="backText">Město: <a class = "email"><?php echo $City ?></a></div>
        <div class="backText">Ulice: <a class = "email"><?php echo $street . " " . $HouseNumber ?></a></div>
        <div class="backText">Web: <a class = "email"><?php echo $webPage ?></a></div>
        <div class="backText">hleda práci?: <a class = "email"><?php echo $status ?></a></div>
    </div>
  </body>
</html>