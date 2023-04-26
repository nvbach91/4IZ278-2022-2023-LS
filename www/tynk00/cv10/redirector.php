<?php


$normal = ["home.php"];

$unlogged = ["login.php", "register.php", 'logout.php'];

$logged = ['cart.php', "product.php", "logout.php", "world-clock.php", "profile.php", "users.php"];

$managerPages = ['deleteProduct.php', 'insertProduct.php', 'productEdit.php', 'databaseManager.php', 'categoryEdit.php', 'productEdit.php'];

$adminPages = ['privilegeForm.php', 'databaseManager.php?database=users'];

if (!isset($loggedUser)) {
    if (in_array(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME). ".php", $logged) || in_array(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME). ".php", $managerPages)) {
        header("Location: login.php");
    }
}
else{
    if (in_array(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME). ".php", $unlogged)) {
        header("Location: home.php");
    }
    else {
        $user = $usersDatabase->getLoggedUser($loggedUser);
        if(!$usersDatabase->isManager($user)){
            if (in_array(ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)). ".php", $managerPages)) {
                header("Location: home.php");
            }
        }
        if(!$usersDatabase->isAdmin($user)){
            $pri = isset($_GET['database']) ? '?database=' . $_GET['database'] : '';
            echo ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)). ".php".$pri;
            if (in_array(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME). ".php".$pri, $adminPages)) {
                header("Location: home.php");
            }
        }
    }

}


?>