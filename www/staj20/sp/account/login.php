<?php
session_start();
require_once __DIR__ . '/../assets/php/core.php';
$csrf_good = csrf_check();

if(isset($_POST['user_id'])){
    header('Location: index.php');
    exit;
}
require_once( __DIR__ . '/../assets/config/google.php');
# the createAuthUrl() method generates the login URL.
$login_url = $client->createAuthUrl();
/* 
 * After obtaining permission from the user,
 * Google will redirect to the login.php with the "code" query parameter.
*/
if (isset($_GET['code'])) :

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token['error'])) {
        header('Location: login.php');
        exit;
    }
    $account = new Account();
    $account->loginGoogle($client);
    $_SESSION['gtoken'] = $token;
    header('Location: index.php');
    exit;

endif;
if (isset($_POST['submit-login']) && $csrf_good) {
    if (
        isset($_POST['username'])
        && isset($_POST['password'])
    ) {
        $username = verify($_POST['username']);
        $password = verify($_POST['password']);
        $account = new Account();
        $account->login($username, $password, $errorMsg);
        if (empty($errorMsg)) {
            header("Location:  index.php");
        }
    } else {
        $errorMsg = "Vyplňte uživatelské jméno a heslo.";
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
            <h1>Přihlásit se</h1>
            <a class="link-button" href="signup.php">Nemáte účet? Registrovat se</a>
            <h2>Přihlásit se</h2>
            <p><?php if (isset($errorMsg)) {
                    echo $errorMsg;
                } ?></p>
            <form class="form" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">             
                <div class="form-group">
                    <label for="username">Uživatelské jméno nebo emailová adresa</label>
                    <input type="name" name="username" class="form-item" placeholder="Uživatelské jméno/Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Heslo</label>
                    <input type="password" name="password" class="form-item" placeholder="Heslo" required>
                </div>
                <br>
                <button class="link-button" name="submit-login" type="submit">Přihlásit se</button>
            </form>
            <a class="link-button" href="<?= $login_url ?>">Přihlásit se pomocí Google</a><br>
        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>