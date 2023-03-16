<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"):
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST['pass'];
    $passAgain = $_POST['passAgain'];
    $submit = $_POST['submit'];
    $errors = array();

    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    if (empty($pass)){
        $errors["pass"] = "Password is required";
    }
    elseif ($pass != $passAgain){
        $errors['pass'] = "Passwords do not match";
    }
    if (empty($passAgain)){
        $errors["passAgain"] = "Confirmation of password is required";
    }
endif;
    ?>
