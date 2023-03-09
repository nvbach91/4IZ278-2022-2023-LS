<?php 
$name = 'Maksym Kushchynskyi';
$avatar = 'https://cdn.vox-cdn.com/thumbor/Yd7b7iobK45wxkAo-62R39OItbU=/1400x1400/filters:format(png)/cdn.vox-cdn.com/uploads/chorus_asset/file/16329042/cyberpunk_2077_keanu_reeves_1920.png';
$phone = '+333 333 333 333';
$address = 'Praha 3';
$something = 'Something about me.';
$somethingElse = 'Something else about me.';
$somethingMore = 'And a bit more.';
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
            <img width="125" src="<?php echo $avatar; ?>" alt="avatar">
        </div>
        <div class="something">
            <?php echo $something; ?>
        </div>
        <div class="somethingElse">
            <?php echo $somethingElse; ?>
        </div>
        <div class="somethingMore">
            <?php echo $somethingMore; ?>
        </div>
    </div>
</body>
</html>