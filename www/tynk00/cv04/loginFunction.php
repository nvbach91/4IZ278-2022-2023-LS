<?php

$errors = [];


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if ($email == "") {
        array_push($errors, "Přezdívka nebyla vyplněna");
        $email = "";
        return;
    } else {
        $user = getUser2($email);

        if ($user != null) {
            if (isset($_POST['password'])) {
                $password = $_POST['password'];
                if ($user->password == $password) {
                } else {
                    array_push($errors, "Zadané heslo je nesprávné");
                }
            } else {
                array_push($errors, "Heslo nebylo vyplněno");
            }
        } else {
            array_push($errors, "Uživatel s touto přezdívkou nebyl nalezen");
        }
    }
} else {
    $email = "";
}


if(empty($errors) && !empty($email)){
    
    $success = "Přihlášení bylo úspěšné!";
    header('location: users.php?success=1');
    exit;
}