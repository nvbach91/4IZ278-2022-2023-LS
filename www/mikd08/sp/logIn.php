<?php
require_once 'db.php';

session_start();

if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // zajimavost: mysql porovnani retezcu je case insensitive, pokud dame select na NECO@DOMENA.COM, najde to i zaznam neco@domena.com
    // viz http://dev.mysql.com/doc/refman/5.0/en/case-sensitivity.html

    $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username LIMIT 1'); //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'username' => $username
    ]);
    
    $existing_user = $stmt->fetchAll()[0];
    //TODO ajax errors
    if ($existing_user == null) {
        $_SESSION["error"] = "Unknown user";
    }

    if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = htmlentities($existing_user['user_id']);
        $_SESSION['name'] = htmlentities($existing_user['name']);
        $_SESSION['isAdmin'] = htmlentities($existing_user['isAdmin']);
        
        setcookie('user', $username, time() + 3600);

        if ($existing_user['isAdmin'] == "false") {
            if (!isset($_SESSION["cart"])) {
                $_SESSION["cart"] = [];
            }
        } 


        

    } else {
        //TODO ajax 
    
        $_SESSION["error"] = "Wrong password";
    }
    header('Location: index.php');
    exit;
}
?>
