<?php
require('./db/UsersDatabase.php');
require_once './vendor/autoload.php';
session_start();
$usersDB = new usersDatabase();

$rulesRegistration = [
    'required' => ['email', 'password', 'confirmPassword', 'name', 'surname', 'phone', 'postalCode'],
    'email' => ['email'],
    'lengthBetween' => [
        ['password', 8, 32]
    ],
    'equals' => [
        ['password', 'confirmPassword']
    ],
    'length' => [
        ['phone', 9]
    ]
];

if (!empty($_POST)) {
    $v = new \Valitron\Validator($_POST);
    $v->rules($rulesRegistration);
    if ($v->validate()) {

        $email = $_POST['email'];
        $name  =  $_POST['name'];
        $surname  =  $_POST['surname'];
        $adress = $_POST['adress'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $postalCode = $_POST['postalCode'];
        $emailCheck = $usersDB->fetchByEmail($email);

        if (empty($emailCheck)) {
            $usersDB->create(
                [
                    'email' => $email,
                    'name' => $name,
                    'surname' => $surname,
                    'adress' => $adress,
                    'phone' => $phone,
                    'password' => $password,
                    'postalCode' => $postalCode
                ]
            );
            $_SESSION['message'] = 'Registration complete!';
            header("Location: login.php");
        } else {
            $_SESSION['message'] = 'This E-mail adress already exists, try to login';
            header("Location: login.php");
        }
    } else {
        $errors = '<ul>';
        foreach ($v->errors() as $error) {
            foreach ($error as $item) {
                $errors .= "<li>{$item}</li>";
                header("Location: registration.php");
            }
        }
        $errors .= "</ul>";
        $_SESSION['message'] = $errors;
    }
}
