<?php
require_once "./database/UsersDatabase.php";

$isRegistrationSuccesful = false;
$userDB = new UsersDatabase();

if(!empty($_POST)){
    $errors=[];
    $email = htmlspecialchars($_COOKIE["username"]);
    $firstName = htmlspecialchars($_COOKIE["first_name"]);
    $lastName = htmlspecialchars($_COOKIE["last_name"]);
    $city = htmlspecialchars($_POST["city"]);
    $street = htmlspecialchars($_POST["street"]);
    $buildingNo = htmlspecialchars($_POST["buildingNo"]);
    $zipCode = htmlspecialchars($_POST["zipCode"]);
    $isRegistrationSuccesful = true;

    //email

    if(strlen($email)<=0){
        $error="Please enter your e-mail.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error="E-mail is not valid.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }elseif($userDB->checkEmail($email)){
        $error="E-mail already in use.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }

    //first name
    if(strlen($firstName)<=0){
        $error="Please enter your first name.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    elseif(!preg_match("/^([a-zA-Z' ]+)$/",$firstName)){
        $error="First name is not valid.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    //last name
    if(strlen($lastName)<=0){
        $error="Please enter your last name.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    if(!preg_match("/^([a-zA-Z']+)$/",$lastName)){
        $error="Last name is not valid.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    //city
    if(strlen($city)<=0){
        $error="Please enter your city.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    if(!preg_match("/^([a-zA-Z]+(?:. |-| |'))*[a-zA-Z0-9]*$/",$city)){
        $error="City is not valid.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    //city
    if(strlen($street)<=0){
        $error="Please enter your street.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    if(!preg_match("/^([a-zA-Z]+(?:. |-| |'))*[a-zA-Z0-9]*$/",$street)){
        $error="Street is not valid.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    //buildingNo.
    if(strlen($buildingNo)<=0){
        $error="Please enter your building number.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    elseif(!filter_var($buildingNo, FILTER_VALIDATE_INT)){
        $error="Building number is not valid.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    //zipCode
    if(strlen($zipCode)<=0){
        $error="Please enter your zip code.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }
    elseif(!preg_match("/^\d{5}$/",$zipCode)){
        $error="Zip code is not valid.";
        array_push($errors,$error);
        $isRegistrationSuccesful = false;
    }

    foreach($errors as $error){
        echo "<div class='error'>$error</div>";
    }

    if($isRegistrationSuccesful){
        $userDB->addUser($email,"",$firstName,$lastName,$city,$street,$buildingNo,$zipCode, "user");
        header("Location: ./index.php");
        exit;
    }
}
else{
    $email = $_COOKIE["username"];
    $firstName = $_COOKIE["first_name"];
    $lastName = $_COOKIE["last_name"];
    $city = "";
    $street = "";
    $buildingNo = "";
    $zipCode = "";
}
