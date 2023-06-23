<?php
require_once "./database/UsersDatabase.php";
require_once "./database/ItemsDatabase.php";

$isRegistrationSuccesful = false;
$userDB = new UsersDatabase();
$itemsDB = new ItemsDatabase();

if(!empty($_POST)){
    $errors=[];
    $mode="";
    if(isset($_POST["userid"])){
        $email = htmlspecialchars($_POST["email"]);
        $firstName = htmlspecialchars($_POST["firstname"]);
        $lastName = htmlspecialchars($_POST["lastname"]);
        $city = htmlspecialchars($_POST["city"]);
        $street = htmlspecialchars($_POST["street"]);
        $buildingNo = htmlspecialchars($_POST["buildingno"]);
        $zipCode = htmlspecialchars($_POST["zipcode"]);
        $role = htmlspecialchars($_POST["role"]);
        $id = htmlspecialchars($_POST["userid"]);
        $mode = "user";
    }elseif(isset($_POST["itemid"])){
        $id = htmlspecialchars($_POST["itemid"]);
        $name = htmlspecialchars($_POST["name"]);
        $price = htmlspecialchars($_POST["price"]);
        $description = htmlspecialchars($_POST["description"]);
        $image = htmlspecialchars($_POST["image"]);
        $category = htmlspecialchars($_POST["category"]);
        $mode = "item";
    }
    $isRegistrationSuccesful = true;

    if($mode== "user"){
    
        //email

        if(strlen($email)<=0){
            $error="Please enter your e-mail.";
            array_push($errors,$error);
            $isRegistrationSuccesful = false;
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error="E-mail is not valid.";
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
    }elseif($mode="item"){
        if(strlen($name)<=0){
            $error="Please enter name of the item.";
            array_push($errors,$error);
            $isRegistrationSuccesful = false;
        }
        if($price<0){
            $error="Please enter correct price of the item.";
            array_push($errors,$error);
            $isRegistrationSuccesful = false;
        }
        if(strlen($description)<=0){
            $error="Please enter description of the item.";
            array_push($errors,$error);
            $isRegistrationSuccesful = false;
        }
        if(strlen($image)<=0){
            $error="Please enter image URL of the item.";
            array_push($errors,$error);
            $isRegistrationSuccesful = false;
        }
        if(!filter_var($image,FILTER_VALIDATE_URL)){
            $error="Image URL is not valid.";
            array_push($errors,$error);
            $isRegistrationSuccesful = false;
        }
    }

    foreach($errors as $error){
        echo "<div class='error'>$error</div>";
    }

    if($isRegistrationSuccesful){
        if($mode=="user"){
            $userDB->changeUserInfo($id,$email,$firstName,$lastName,$city,$street,$buildingNo,$zipCode, $role);
        }
        elseif($mode=="item"){
            $itemsDB->changeItemInfo($id,$name, $price, $description, $image, $category);
        }
        header("Location: ./admin.php");
        exit;
    }
}
