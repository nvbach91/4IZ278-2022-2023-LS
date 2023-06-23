<?php
require_once 'index.php';
if (isset($_POST['extraInfo'])) {
    $_SESSION['user']['postalCode'] = $_POST['postalCode'];
    $_SESSION['user']['adress']= $_POST['adress'];
    $_SESSION['user']['surname']=$_POST['surname'] ;
    $_SESSION['user']['phone']= $_POST['phone'];
    $usersDB->create(
        [
            'email' =>  $_SESSION['user']['email'],
            'name' =>  $_SESSION['user']['name'],
            'surname' => $_POST['surname'],
            'adress' => $_POST['adress'],
            'phone' => $_POST['phone'],
            'password' => $password,
            'postalCode' => $_POST['postalCode']
        ]
    );
    header("Location:ourProducts.php");
}
if (empty($_SESSION['user']['adress'])) { ?>
<h1>We need extra information from you!</h1>
    <form action="" method="POST">
        <input type="text" name='adress' value="adress">
        <input type="text" name='postalCode' value="postalCode">
        <input type="text" name='phone' value="phone">
        <input type="text" name='surname' value="surname">
        <input type="submit" name='extraInfo' value="Procced!">
    </form>
<?php }?>