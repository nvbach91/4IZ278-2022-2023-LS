<?php
$name = "Floppa the Cat";
$age = 20;
$prof = 'DevOps Specialist';
$firm = 'Carvago';
$street = 'Landsberger';
$num = 26;
$num2 = 1412;
$city = "Berlin";
$tel = "+420775439849";
$email = "test@test.com";
// TODO: avatar
$avatar = "https://yt3.googleusercontent.com/1H0pCwfSIJdvCkGASZboVkPVxScmES_KcnqB5y9OetXo8YjU02jq_s8W58UMOnGV2mGFFAXRrg=s900-c-k-c0x00ffffff-no-rj";
$work = true;
$www_address = "https://carvago.com";
$github = "https://github.com/utikpuhlik";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Business Card</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="block">
        <div class="flex">
            <div class="com-8">
                <div class="avatar" style="background-image: url(<?php echo $avatar?>)"></div>
            </div>
            <div class="info">
                <h2 class="name"><?php echo $name?></h2>
                <h3>Position: <?php echo $prof?></h3>
                <p>Address: <?php echo $street . " " . $num . ", " . $city?></p>
                <p>Looking for work: <?php echo $work ? "Yes" : "No"?> </p>
            </div>
        </div>
        <div class="foot">
            <div>
                Github: <a href="<?php echo $github?>">@utikpuhlik</a>
        </div>
    </div>

    <div class="container">
        <div class="meow line">
            <div class="contact">
                <h2 class="header_contacts">Contacts:</h2>
                <p>
					<a href="tel:+434781241">tel: <?php echo $tel?></a>
				</p>
                <p>
					<a href="mailto:cat@example.com">mail: <?php echo $email?></a>
				</p>
            </div>
        </div>
        <div class="meow">
            <div class="contact">
                <h2>Details:</h2>
                <p>Age: <?php echo $age?></p>
				<p>Firm: <?php echo $firm?></p>
            </div>
        </div>

    </div>

</body>
</html>


