<?php
session_start();
require_once __DIR__ . '/../assets/php/core.php';
$csrf_good = csrf_check();
if(isset($_SESSION['address']) && !isset($_GET['change-address'])){
    header("Location:  confirm.php");
}
if(isset($_POST['submit-address']) && $csrf_good){
    if(
    isset($_POST['name']) &&
    isset($_POST['street']) &&
    isset($_POST['zip']) &&
    isset($_POST['city']) &&
    isset($_POST['country']) &&
    isset($_POST['email'])
    ){
        $address = new Address();
        $address->name=verify($_POST['name']);
        $address->street=verify($_POST['street']);
        $address->zip=verify($_POST['zip']);
        $address->city=verify($_POST['city']);
        $address->country=verify($_POST['country']);
        $address->email=verify($_POST['email']);
        if(!filter_var($address->zip, FILTER_VALIDATE_INT)){
            $errorMsg = "Poštovní číslo musí být číslo.";
        }
        elseif(!filter_var($address->email, FILTER_VALIDATE_EMAIL)){
            $errorMsg="Email je špatně zadaný.";
        }
        else{
            if(isset($_POST['phone'])){
                $address->phone=verify($_POST['phone']);
            }
            if(isset($_POST['additional_info'])){
                $address->additional_info=verify($_POST['additional_info']);
            }
            $_SESSION['address'] = serialize($address);
            header("Location:  confirm.php");
        }
    }
    else{
        $errorMsg = "Je potřeba vyplnit všechny povinné údaje.";
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
                <a class="nav-item" href="../account">
                    <p>Uživatelský účet</p>
                </a>
                <a class="nav-item" href="../cart">
                    <p>Nákupní košík</p>
                </a>
            </nav>
        </header>
        <main>
            <h1>Vytvoření objednávky</h1>
            <h2>Dodací adresa</h2>
            <p><?php if(isset($errorMsg)){ echo $errorMsg;} ?></p>
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">             
                <label for="name">Jméno*:</label>
                <br><input type="text" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" required>
                <br><label for="street">Ulice*:</label>
                <br><input type="text" name="street" value="<?php if(isset($_POST['street'])){echo $_POST['street'];} ?>" required>
                <br><label for="zip">PSČ*:</label>
                <br><input type="text" name="zip" value="<?php if(isset($_POST['zip'])){echo $_POST['zip'];} ?>" required>
                <br><label for="city">Město*:</label>
                <br><input type="text" name="city" value="<?php if(isset($_POST['city'])){echo $_POST['city'];} ?>" required>
                <br><label for="country">Stát*:</label>
                <br><input type="text" name="country" value="<?php if(isset($_POST['country'])){echo $_POST['country'];} ?>" required>
                <br><label for="email">Email*:</label>
                <br><input type="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" required>
                <br><label for="phone">Telefon:</label>
                <br><input type="text" name="phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>">
                <br><label for="additional_info">Další informace pro dodání:</label>
                <br><input type="text" name="additional_info" value="<?php if(isset($_POST['additional_info'])){echo $_POST['additional_info'];} ?>">
                <button class="link-button" type="submit" name="submit-address">Pokračovat s objednávkou</button>
            </form>
        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>