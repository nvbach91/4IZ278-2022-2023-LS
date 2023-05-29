<?php
session_start();
require_once __DIR__.'/db.php';

if (isset($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];

    $errors = [];
    if ($username == "") {
        array_push($errors, "Username is empty");
    }
    if ($password == "") {
        array_push($errors, "Password is empty");
    }
    if ($name == "") {
        array_push($errors, "Name is empty");
    }
    if ($phone == "") {
        array_push($errors, "Phone is empty");  
    } else if (strlen($phone) != 9) {
        array_push($errors, "Phone has wrong amount of digits");
    } 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email not valid");
    }
    if ($address == "") {
        array_push($errors, "Address is empty");
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = PDO->prepare('INSERT INTO user (username, password, name, email, phone, address, isAdmin) VALUES (:username, :password, :name, :email, :phone, :address, "false")');
        $stmt->execute([
            "username" => $username,
            'password' => $hashedPassword,
            'name' => $name, 
            'email' => $email, 
            'phone' => $phone, 
            'address' => $address
        ]);
    } else { 
        http_response_code(400);
        die(json_encode($errors));
    }

    //ted je uzivatel ulozen, bud muzeme vzit id posledniho zaznamu pres last insert id (co kdyz se to potka s vice requesty = nebezpecne),
    // nebo nacist uzivatele podle mailove adresy (ok, bezpecne)

    // $stmt = PDO->prepare('SELECT user_id FROM user WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    // $stmt->execute([
    //     'email' => $email
    // ]);
    // $user_id = (int) $stmt->fetchColumn();

    // $_SESSION['user_id'] = $user_id;
    // $_SESSION['user_email'] = $email;
    // $_SESSION['isAdmin'] = $isAdmin;

    // setcookie('user', $email, time() + 3600);
    // header('Location: /www/mikd08/sp/index.php');
    // exit;
}
?>