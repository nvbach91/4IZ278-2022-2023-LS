<?php

$filename = './users.db';
$fileContent = file_get_contents($filename);
$splitedString = explode(PHP_EOL, $fileContent);

?>
<?php require './src/head.php' ?>
<h1>Login/registration system</h1>
<p>Already have an account? <a href="./login.php">Log in</a></p>
<p>Don't have an account? <a href="./registration.php">Register</a></p>
<p>Admin? <a href="./admin/users.php">Admin page</a></p>
<?php require './src/foot.php' ?>