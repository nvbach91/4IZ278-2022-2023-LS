<?php


$errors = [];

if(isset($_POST['name'])){
    $name = $_POST['name'];
    if($name == ""){
        $errors['name'] = "Jméno nebylo vyplněno";
    }
    else{
        $errors['name'] = "";
    }
}
else{
    $name = "";
    $errors['name'] = "";
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
        $errors['email'] = "E-mail nebyl vyplněn";
    }
    else{
        $errors['email'] = "";
    }
}
else{
    $email = "";
    $errors['email'] = "";
}
if(isset($_POST['tel'])){
    $tel = $_POST['tel'];
    if($tel == ""){
        $errors['tel'] = "Telefonní číslo nebylo vyplněno";
    }
    else{
        $errors['tel'] = "";
        if(!is_numeric($tel)){
            $errors['tel'] = "Telefonní číslo by se mělo skládat z číslic.";
        }
        else{
            $errors['tel'] = "";
            if(strlen($tel) != 9){
                $errors['tel'] = "Telefonní číslo by mělo obsahovat 9 číslic";
            }
            else{
                $errors['tel'] = "";
            }
        }
    }
    
    
}
else{
    $tel = "";
    $errors['tel'] = "";
}
if(isset($_POST['avatar'])){
    $avatar = $_POST['avatar'];
    if($avatar == ""){
        $errors['avatar'] = "Url adresa profilového obrázku nebyla vyplněna";
    }
    else{
        $errors['avatar'] = "";
    }
}
else{
    $avatar = "";
    $errors['avatar'] = "";
}
if(isset($_POST['deckName'])){
    $deckName = $_POST['deckName'];
    if($deckName == ""){
        $errors['deckName'] = "Název balíčku nebyl vyplněn";
    }
    else{
        $errors['deckName'] = "";
    }
}
else{
    $deckName = "";
    $errors['deckName'] = "";
}
if(isset($_POST['cards'])){
    $cards = (int) $_POST['cards'];
    if(!is_numeric($_POST['cards'])){
        $errors['cards'] = "Číslo není ve správném formátu";
    }
    else{
        $errors['cards'] = "";
        if($cards < 0 || $cards > 20){
            $errors['cards'] = "Počet karet musí být více než 0 a méně nebo rovno 20";
        }
        else{
            $errors['cards'] = "";
        }
    }
}
else{
    $errors['cards'] = "";
    $cards = 5;
}





?>