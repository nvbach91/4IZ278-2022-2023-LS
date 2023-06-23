<?php
session_start();
require_once __DIR__ . '/../assets/php/core.php';
$csrf_good = csrf_check();
if(isset($_POST['submit-signup']) && $csrf_good){
    if(isset($_POST['username'])
    && isset($_POST['email'])
    && isset($_POST['password'])
    && isset($_POST['password-check'])){
        $username = verify($_POST['username']);
        $email = verify($_POST['email']);
        $password = verify($_POST['password']);
        $passwordCheck = verify($_POST['password-check']);
        if($password != $passwordCheck){
            $errorMsg="Hesla musí být identická.";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errorMsg="Email je špatně zadaný.";
        }
        else{
            $account = new Account();
            $account->signup($username,$email,$password,$errorMsg);
            if(!isset($errorMsg)){
                header("Location:  index.php");
            }
        }
    }
    else{
        $errorMsg="Pro registraci je potřeba vyplnit všechny údaje.";
    }
}
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Staromor</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css">
    <link rel="stylesheet" media="print" href="../assets/css/print.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Obchod, Starožitnosti, Starožitnost, sklo, porcelán, kvalitní">
    <meta name="description" content="Obchod se starožitnosti">
    <meta name="author" content="Jakub Starosta">
</head>

<body>
    <div class="wrapper">
        <header>
            <nav class="nav-list">
                <a class="nav-item" href="../">
                    <p>Staromor</p>
                </a>
                <a class="nav-item" href="../store">
                    <p>Obchod</p>
                </a>
                <a class="nav-item-current" href="../account">
                    <p>Uživatelský účet</p>
                </a>
                <a class="nav-item" href="../cart">
                    <p>Nákupní košík</p>
                </a>
            </nav>
        </header>
        <main>
            <h1>Registrovat účet</h1>
            <h2>Registrace</h2>
            <p><?php if(isset($errorMsg)){ echo $errorMsg;} ?></p>
            <form class="form" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">             

                <div class="form-group">
                    <label for="username">Uživatelské jméno</label>
                    <input type="name" name="username" class="form-item" placeholder="Uživatelské jméno" required>
                </div>
                <div class="form-group">
                    <label for="email">Emailová adresa</label>
                    <input type="email" name="email" class="form-item" placeholder="Emailová adresa" required>
                </div>
                <div class="form-group">
                    <label for="password">Heslo</label>
                    <input type="password" name="password" class="form-item" placeholder="Heslo" required>
                </div>
                <div class="form-group">
                    <label for="password">Heslo (kontrola)</label>
                    <input type="password" name="password-check" class="form-item" placeholder="Heslo" required>
                </div>
                <br>
                <button class="link-button" name="submit-signup" type="submit">Vytvořit účet</button>
            </form>
        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>