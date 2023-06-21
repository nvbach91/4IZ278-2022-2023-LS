<?php

$rulesLogin = [
    'required' => ['email', 'password'],
    'email' => ['email'],
    'lengthBetween'=>[
        ['password', 8,32]
    ],
    
];
if (!empty($_POST)) {
    $v = new \Valitron\Validator($_POST);
    $v->rules($rules);
    if ($v->validate()) {
        $_SESSION['success'] = 'Confirmed';
    } else {
        $errors = '<ul>';
        foreach($v->errors() as $error){
            foreach($error as $item){
                $errors.="<li>{$item}</li>";
            }
        }
        $errors.="</ul>";
        $_SESSION['errors'] = $errors;
    }
    header("Location: login.php");
    die;
}
