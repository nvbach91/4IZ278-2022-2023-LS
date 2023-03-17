<?php


require 'utils.php';

$errors = [];

$success = "";


$formIsSubmitted = !empty($_POST);

if(isset($_POST['name'])){
    $name = $_POST['name'];
    if($name == ""){
        array_push($errors, "Jméno nebylo vyplněno");
    }

}
else{
    $name = "";
}

if(isset($_POST['password'])){
    $password = $_POST['password'];
    $passwordAgain = $_POST['passwordAgain'];
    if($password == ""){
        array_push($errors, "Heslo nebylo vyplněno!");
    }
    else {
        if(strlen($password) < 6){
            array_push($errors, "Vaše heslo je přiliš krátké!");
        }
        else {
            if($password != $passwordAgain){
                array_push($errors, "Hesla se neshodují!");
            }
        }
    }

}
else{
    $password = "";
}


if(isset($_POST['sex'])){
    $sex = $_POST['sex'];

}
else{
    $sex = "m";
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
    if($email == ""){
        array_push($errors, "E-mail nebyl vyplněn");
    }
}
else{
    $email = "";
}
if(isset($_POST['tel'])){
    $tel = $_POST['tel'];
    if($tel == ""){
        array_push($errors, "Telefonní číslo nebylo vyplněno");
    }
    else{
        if(!is_numeric($tel)){
            array_push($errors, "Telefonní číslo by se mělo skládat z číslic.");
        }
        else{
            if(strlen($tel) != 9){
                array_push($errors, "Telefonní číslo by mělo obsahovat 9 číslic");
            }
        }
    }


}
else{
    $tel = "";
}
if(isset($_POST['avatar'])){
    $avatar = $_POST['avatar'];
    if($avatar == ""){
        array_push($errors, "Url adresa profilového obrázku nebyla vyplněna");
    }
}
else{
    $avatar = "";
}
if(isset($_POST['deckName'])){
    $deckName = $_POST['deckName'];
    if($deckName == ""){
        array_push($errors, "Název balíčku nebyl vyplněn");
    }
}
else{
    $deckName = "";
}
if(isset($_POST['cards'])){
    $cards = (int) $_POST['cards'];
    if(!is_numeric($_POST['cards'])){
        array_push($errors, "Číslo není ve správném formátu");
    }
    else{
        if($cards < 0 || $cards > 20){
            array_push($errors, "Počet karet musí být více než 0 a méně nebo rovno 20");
        }
    }
}
else{
    $cards = 5;
}


$usersFilePath = './users.db';
$existingUser = getUser($email);

if($existingUser != null){
    array_push($errors, "Tento email již existuje");
}


if(empty($errors) && !empty($email)){
    
    if(file_get_contents($usersFilePath) == ""){
        $record = "$email;$name;$avatar;$sex;$deckName;$tel;$cards;$password";
    }
    else{
        $record = PHP_EOL . "$email;$name;$avatar;$sex;$deckName;$tel;$cards;$password";
    }

    file_put_contents($usersFilePath, $record, FILE_APPEND);
    $success = "Registrace byla úspěšná!";
    header('location: login.php?email=' . $_POST['email'] . '&registration=1');
    exit;
}


?>