<?php
$name="Camila";
$lastname="Bigunets";
$age=27;
$position="coach";
$phoneNumber="+420 773 544 675";
$email="bigunets03@gmail.com";
$address="Praha,Jeseniova 216";
$available=true;
$fullName=$name . $lastname;
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
    <div class="Name">
        <h1>Business Card</h1>
    </div>
        
    <div class="FrontSide">
        <div class="picture">
            <img src="img/holka..jpeg">
        </div>
        <div class="text2">
            <P><?php echo $fullName?></P>
            <P><?php echo $age?> y.o </P>
            <P><?php echo $position?></P>

        </div>
    </div>
    <div class="BackSide">
        <div class="text">
            <P><?php echo $phoneNumber?></P>
            <P><?php echo $email?></P>
            <P><?php echo $address?></P> 
            <p><?php echo $available ? "available" : "not available"?></p>
        </div>

     
    </div>

</body>
</html>