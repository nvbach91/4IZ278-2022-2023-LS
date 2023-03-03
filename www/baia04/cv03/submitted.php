<?php 
    require('./header.php');

    require('./utils.php');
    require('./errorsStrings.php');

    $submittedForm = !empty($_POST);
    $utils = new Utils();
    $errors = array();

    if ($submittedForm) {

        $fullname = $utils -> chars($_POST['name']);
        $sex = $utils -> chars($_POST['sex']);
        $email = $utils -> chars($_POST['email']);
        $phone = $utils -> chars($_POST['phone']);
        $url = $utils -> chars($_POST['url']);

        $errors = $utils -> validate($fullname, $sex, $email, $phone, $url);
    }
    require('./body.php');

?>