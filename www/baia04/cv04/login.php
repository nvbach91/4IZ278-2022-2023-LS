<?php 
    $page = 'login.php';
    require('./src/header.php');

    require('./utils/utils.php');
    require('./errorsStrings.php');

    $submittedForm = !empty($_POST);
    $utils = new Utils();
    $errors = array();

    if ($submittedForm) {
        $data = $utils -> getData();
        $errors = $utils -> validateLogin($data);
        if (!count($errors)) {
            if (!$utils -> isUserExists($data['email'])) {
                array_push($errors, 5);
            } else if (!$utils -> isPasswordCorrect($data['pass1'], $data['email'])) {
                array_push($errors, 6);
            }
        }
        
    }
    require('./src/body.php');

?>