<?php 
$name = 'John Doe';
$avatar = 'https://hips.hearstapps.com/hmg-prod/images/barack-obama-12782369-1-402.jpg';
$phone = '+420 777 555 888';
$address = 'Praha 1';

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
        <div class="bc-name">
            <?php echo $name; ?>
        </div>
        <div class="bc-phone">
            <?php echo $phone; ?>
        </div>
        <div class="bc-address">
            <?php echo $address; ?>
        </div>
        <div class="bc-avatar">
            <img width="150" src="<?php echo $avatar; ?>" alt="avatar">
        </div>
    </div>
</body>
</html>