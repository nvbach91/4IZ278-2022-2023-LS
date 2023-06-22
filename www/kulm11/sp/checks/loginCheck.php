<?php require_once "./database/UsersDatabase.php";

$isLoginSuccesful = false;
$userDB = new UsersDatabase();

if(!empty($_POST)){
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $errors = [];
    $isLoginSuccesful = true;

    //username exists check
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "E-mail isn't valid.";
        array_push($errors,$error);
        $isLoginSuccesful = false;
    }
    elseif(!$userDB->checkEmail($email)){
        $error = "User with this e-mail doesn't exist.";
        array_push($errors,$error);
        $isLoginSuccesful = false;
    }elseif(!$userDB->checkLogin($email,$password)){
        $error = "Password is incorrect.";
        array_push($errors,$error);
        $isLoginSuccesful = false;
    }

    foreach($errors as $error){
        echo "<div class='error'>$error</div>";
    }

    if($isLoginSuccesful){
        setcookie("username", $email, time()+3600);
        $_SESSION["isLoggedIn"]=true;
        header("Location: ./index.php");
        exit;
    }

}
else{
    $email="";
}
