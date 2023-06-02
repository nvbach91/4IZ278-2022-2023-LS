<?php 
    session_start();
    require_once __DIR__."/fb/vendor/autoload.php";
    require_once __DIR__."/fb/fbConf.php";

    $facebook = new \JanuSoftware\Facebook\Facebook(FB_CONF);
    $helper = $facebook->getRedirectLoginHelper();
    const LINK = "http://localhost/www/mikd08/";
    $permissions = ["email"];
    $redirectURL = $helper->getLoginUrl(
        LINK."sp/fb/fb-login-callback.php", $permissions
    );
//TODO active link ,
// konstanta na localhost, 
//edit product img, 
//active sloupec db,
// search bar
?>

<!DOCTYPE html>
<html lang="en">  
    <head>
        <?php require __DIR__."/head.php"?>

    </head>
    <body>
        <?php require __DIR__."/nav.php"?>
        <?php if(isset($_SESSION["success"])):?> 
            <h2 style="color:green;"><?php echo $_SESSION["success"]; unset($_SESSION["success"]);?></h2>
        <?php endif ?>
        <?php if(isset($_SESSION["error"])):?> 
            <h2 style="color:red;"><?php echo $_SESSION["error"]; unset($_SESSION["error"]);?></h2>
        <?php endif ?>

        <?php require __DIR__."/products.php"?>
        <?php if(empty($_COOKIE["user"]) && empty($_SESSION["user_id"])):?> 
            <?php require __DIR__."/userForms.php"; ?>
        <?php elseif(isset($_COOKIE["user"]) && isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == "true"):?> 
            <?php require __DIR__."/admin/adminForms.php"; ?>
        <?php endif ?>


    </body>
</html>