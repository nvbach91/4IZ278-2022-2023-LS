<?php

$usersFilePath = '../users.db';
$usersData = file_get_contents($usersFilePath);
$users = explode(PHP_EOL, $usersData);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Zaregistrovaní uživatelé</h1>
    <ol>
        <?php foreach ($users as $user) : ?>
            <?php $fields = explode(';', $user); ?>
            <li><?php echo $fields[2] ?></li>
        <?php endforeach ?>
    </ol>
</body>

</html>