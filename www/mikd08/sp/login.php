<?php
require_once __DIR__.'/db.php';

session_start();

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //username to unique db
    $stmt = PDO->prepare('SELECT * FROM user WHERE username = :username LIMIT 1'); 
    $stmt->execute([
        'username' => $username
    ]);
    
    $existing_user = $stmt->fetch();
    if ($existing_user == null) {
        http_response_code(400);
        die(json_encode("Unknown user"));
    }

    if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = htmlentities($existing_user['user_id']);
        $_SESSION['name'] = htmlentities($existing_user['name']);
        $_SESSION['isAdmin'] = htmlentities($existing_user['isAdmin']);
        $_SESSION["token"] = bin2hex(random_bytes(32));
        setcookie('user', $username, time() + 3600);

        if ($existing_user['isAdmin'] == "false") {
            if (!isset($_SESSION["cart"])) {
                $_SESSION["cart"] = [];
            }
        } 

    } else {
        http_response_code(400);
        die(json_encode("Wrong password"));
    }

}

?>
