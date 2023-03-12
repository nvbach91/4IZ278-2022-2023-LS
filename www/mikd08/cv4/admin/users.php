<?php 
        $usersData = file_get_contents("../users.db");
        $users = explode("\n", $usersData);
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
    email;phone;password;gender
    <?php foreach ($users as $user): ?>
        <div><?php echo $user ?></div>
    <?php endforeach ?>
</body>
</html>