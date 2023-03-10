<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"):
    $surname = $_POST["surname"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $avatar = $_POST["avatar"];
    $batch = $_POST["batch"];
    $cards = $_POST["cards"];
    $submit = $_POST['submit'];
    $errors = array();

    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    if (empty($surname)) {
        $errors["surname"] = "Surname is required";
    }

    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    if (empty($phone)) {
        $errors["phone"] = "Phone is required";
    } elseif (!preg_match("/^[0-9]+$/", $phone)) {
        $errors["phone"] = "Invalid phone number";
    }

    if (empty($avatar)) {
        $errors["avatar"] = "Avatar URL is required";
    } elseif (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $errors["avatar"] = "Invalid URL format";
    }

    if (empty($batch)) {
        $errors["batch"] = "Name of batch is required";
    }

    if (empty($cards)) {
        $errors["cards"] = "The number of cards is required";
    } elseif (!preg_match("/^[0-9]+$/", $cards)) {
        $errors["cards"] = "The number of cards is invalid";
    }

endif;
