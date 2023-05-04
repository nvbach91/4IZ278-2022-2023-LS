<?php 
    session_start();
    //TODO category and page not working 
    
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