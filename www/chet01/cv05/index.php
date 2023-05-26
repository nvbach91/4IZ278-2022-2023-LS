<?php
require './database.php';
$users = new UsersDB();
$users->create(['name' => 'John', 'surname' => 'Smith']);
$users->fetch();
$users->save();
$users->delete();
echo PHP_EOL;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cv4</title>
</head>

<body>
    <button><a href="./registration.php">Go to registration</a></button>
    <button><a href="./login.php">Go to login</a></button>
</body>

</html>