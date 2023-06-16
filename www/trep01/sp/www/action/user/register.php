<?php

$registerError = false;

$db = new Database();

if (isset($_POST["user_email"], $_POST["user_password"], $_POST["user_password_repeat"]))
{
    $usersR = new UsersRepository($db);
    $user = $usersR->getUserByEmail($_POST["user_email"]);

    if ($user === true){
        $registerError = true;
    }elseIf ($_POST["user_password"] !== $_POST["user_password_repeat"]){
        $registerError = true;
    }else{
        $usersR ->addUser($_POST["user_email"], $_POST["user_password"]);
        header("location: /index.php");
    }


}
