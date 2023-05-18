<?php 
    session_start();
    require_once __DIR__."/fb/vendor/autoload.php";

    require_once __DIR__."/fb/fbConf.php";
    $facebook = new \JanuSoftware\Facebook\Facebook(FB_CONF);
    $helper = $facebook->getRedirectLoginHelper();

    $permissions = ["email"];
    $redirectURL = $helper->getLoginUrl(
        "http://localhost/www/mikd08/sp/fb/fb-login-callback.php", $permissions
    );
    //TODO cookie problem
    // if (isset($_SESSION["fbLogin"])) {
    //     setcookie('user', $_SESSION["name"], time() + 3600);
    // }

    var_dump(isset($_COOKIE["user"]) && isset($_SESSION["cart"]));
    var_dump($_SESSION["isAdmin"] == "false");
    var_dump(isset($_SESSION["cart"]));
    var_dump(isset($_COOKIE["user"]));


?>

<!DOCTYPE html>
<html lang="en">  
    <head>
        <?php require "head.php"?>

    </head>
    <body>
        <?php require "nav.php"?>
        <?php if(isset($_SESSION["error"])):?> 
            <h2 style="color:red;"><?php echo $_SESSION["error"]; unset($_SESSION["error"]);?></h2>
        <?php endif ?>

        <?php require "products.php"?>
        <?php if(empty($_COOKIE["user"])):?> 
            <?php require "userForms.php"; ?>
        <?php elseif(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == "true"):?> 
            <?php require "adminForms.php"; ?>
        <?php endif ?>


    </body>
</html>