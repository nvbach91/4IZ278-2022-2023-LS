<?php

use PhpParser\Node\Stmt;

require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/../db.php";


    if (!empty($_GET)) {
        $initCode = $_GET["code"];

        session_start();
        $_SESSION["fb_init_code"] = $initCode;

        require_once __DIR__."/fbConf.php";
        $facebook = new \JanuSoftware\Facebook\Facebook(FB_CONF);
        $helper = $facebook->getRedirectLoginHelper();

        $helper->getPersistentDataHandler()->set("state", $_GET["state"]);
        $accessToken = $helper->getAccessToken();

        $fbToken = $accessToken->getValue();

        if(!empty($fbToken)) {
            $facebook = new \JanuSoftware\Facebook\Facebook(
                array_merge(FB_CONF, ["default_access_token" => $fbToken])
            );
        
        
            $fbUser = $facebook->get("/me?fields=name,email,hometown")->getGraphNode();
            // $pic = $facebook->get("/me/picture?redirect=false&height=200")->getGraphNode();
            
            $stmt = PDO->prepare("SELECT * from user WHERE user_id = ".$fbUser->getField("id"));
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                $stmt = PDO->prepare("INSERT INTO user(user_id,name,email,isAdmin) VALUES(?,?,?,'false')");
                $stmt->bindValue(1,$fbUser->getField("id"),PDO::PARAM_STR);
                $stmt->bindValue(2,$fbUser->getField("name"),PDO::PARAM_STR);
                $stmt->bindValue(3,$fbUser->getField("email"),PDO::PARAM_STR);
                $stmt->execute();

            }

            $_SESSION['user_id'] = $fbUser->getField("id");
            $_SESSION['name'] = $fbUser->getField("name");
            $_SESSION['isAdmin'] = "false";
            $_SESSION["token"] = bin2hex(random_bytes(32));

            setcookie('user', $_SESSION["name"], time() + 3600, "/www/mikd08/sp");

            if ($_SESSION['isAdmin'] == "false") {
                if (!isset($_SESSION["cart"])) {
                    $_SESSION["cart"] = [];
                }
            } 
    
        }

        header("Location: /www/mikd08/sp/index.php");
    }

?>