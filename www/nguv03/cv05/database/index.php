<?php require 'database.php'; ?>
<?php
// we create a new instance for each table (users, products) and 
// simply use its public methods
// to achieve this we need OOP
$usersDB = new UsersDB();
$user = $usersDB->fetch(['email' => 'nathan@drake.net']);
var_dump($user);

?>