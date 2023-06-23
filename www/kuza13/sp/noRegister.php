<?php

require_once './vendor/autoload.php';
session_start();


$rulesNoRegistration = [
    'required' => ['email', 'name', 'surname', 'phone', 'adress', 'postalCode'],
    'email' => ['email'],
];

if (!empty($_POST)) {
    $v = new \Valitron\Validator($_POST);
    $v->rules($rulesNoRegistration);
    if ($v->validate()) {

        $email = $_POST['email'];
        $name  =  $_POST['name'];
        $surname  =  $_POST['surname'];
        $adress = $_POST['adress'];
        $phone = $_POST['phone'];
        $postalCode = $_POST['postalCode'];

        $_SESSION['adress'] = [
            'email' => $email,
            'name'=>$name,
            'surname'=>$surname,
            'adress'=>$adress,
            'phone'=>$phone,
            'postalCode'=>$postalCode,
        ];

        header("Location:cart.php");
    } else {
        $errors = '<ul>';
        foreach ($v->errors() as $error) {
            foreach ($error as $item) {
                $errors .= "<li>{$item}</li>";
                header("Location: adressForm.php");
            }
        }
        $errors .= "</ul>";
        $_SESSION['message'] = $errors;
    }
}
