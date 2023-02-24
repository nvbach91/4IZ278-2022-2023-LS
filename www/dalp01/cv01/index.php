<?php
$name = "Big Monke";
$phone = "+420 123 456 789";
$city = "Praha 1";
$street = "Krenova 8";
$age = 50;
$position = "Banana analyst";
$company = "Geek Monkey";
$company_site = "www.geekmonkey.com";
$company_logo = "https://img.freepik.com/premium-vector/awesome-monkey-geek-with-headphone-logo-design_224764-74.jpg";
$avatar = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-xCCjRF_yeABM1fdkCHojXtrYCpfEuD3Lkg&usqp=CAU";
$email = "dalp01@vse.cz";
$looking_for_work = TRUE;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Card</title>
    <link rel="stylesheet" href="css/bc.css">
</head>
<body>
    <div class="bc_front">
        <div class="avatar" style="background-image: url(<?php echo $avatar?>)"></div>
        <div class="name"><?php echo $name?></div>
        <div class="info">
            <div class="line"><?php echo "Position: " . $position ?></div>
            <div class="line"><?php echo "Age: " . $age ?></div>
            <div class="line"><?php echo "Phone: " . $phone ?></div>
            <div class="line"><?php echo "Address: " . $street . ", " . $city ?></div>
        </div>
        <div class="contact">
            <div class="line"><?php echo "Contact email: " . $email ?></div>
            <div class="line"><?php echo "Am I looking for work? " . ( $looking_for_work?"Yes!":"No!" )?></div>
        </div>
        
    </div>
    <div class="bc_back">
        <div class="avatar" style="background-image: url(<?php echo $company_logo?>)"></div>
        <div class="company_name"><?php echo $company ?></div>
        <div class="company_web"><?php echo $company_site ?></div>
    </div>
</body>
</html>