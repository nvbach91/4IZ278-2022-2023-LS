<?php

$name = 'Andrej Skukla';
$address = 'Praha 1';
$phone = '+123456789';
$avatar = 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/President_Barack_Obama.jpg/220px-President_Barack_Obama.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="business-card">
        <div class="bc-avatar"><img width="100" src="<?php echo $avatar; ?>" alt="avatar"></div>
        <div class="bc-name"><?php echo $name; ?></div>
        <div class="bc-address"><?php echo $address; ?></div>
        <div class="bc-phone"><?php echo $phone; ?></div>
    </div>
</body>
</html>