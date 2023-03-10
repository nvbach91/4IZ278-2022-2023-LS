<?php 
    $page = 'login.php';
    require('./src/header.php');

    require('./utils/utils.php');
    require('./errorsStrings.php');

    $submittedForm = !empty($_POST);
    $utils = new Utils();
    $errors = array();
    $page = 'register.php';

    if ($submittedForm) {
        $data = $utils -> getData();
        $errors = $utils -> validateRegister($data);

        echo count($errors);
        if (!count($errors)) {
            if ($utils -> isUserExists($data['email'])) {
                array_push($errors, 4);
            } else {
                $utils -> saveUser($data['fullname'], $data['email'], $data['pass1']);
            }
        }
        
    }
    require('./src/body.php');

?>