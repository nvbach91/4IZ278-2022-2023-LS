<?php 
    require "funcs.php";

    $logInSubmitted = !empty($_POST);

    if ($logInSubmitted) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = validateUser($email);
        if ($user == null) {
            $msg = "User not registered";
        } else if ($user["password"] != $password){
            $msg = "Incorrect password";
        } else {
            $msg = "You successfully logged in";
        }
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body div {
            animation: disappear 3s ease-in-out forwards;
        }

        @keyframes disappear {
            100% {
                visibility: hidden;
            }
        }
    </style>
</head>
<body>
    <?php if ($_SERVER["HTTP_REFERER"] == "http://localhost/www/mikd08/cv4/index.php"): ?>
        <div>
            Succesfully registered
        </div>
    <?php endif ?>
    <h1>Log in</h1>
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="email" value="<?php echo $msg == "Incorrect password" ? $email : "" ?>">
        <input type="text" name="password" placeholder="password">
        <button name="submit">log in</button>
    </form>
    
    <?php if (isset($msg)): ?>
        <h2>
            <?php echo $msg?>
        </h2>
    <?php endif ?>

</body>
<a href="index.php">←</a>
</html>