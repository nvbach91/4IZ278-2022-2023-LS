<?php
session_start();
require_once '../assets/php/core.php';
if(isset($_POST['submit-address'])){
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
        if(isset($_POST['phone'])){
        $address->phone=verify($_POST['phone']);
        }
        if(isset($_POST['extra'])){
            $address->additional_info=verify($_POST['additional_info']);
        }
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
            <form action="." method="post">
                <label for="name">Jméno*:</label>
                <br><input type="text" name="name" required>
                <br><label for="street">Ulice*:</label>
                <br><input type="text" name="street" required>
                <br><label for="zip">Poštovní adresa*:</label>
                <br><input type="text" name="zip" required>
                <br><label for="city">Město*:</label>
                <br><input type="text" name="city" required>
                <br><label for="country">Stát*:</label>
                <br><input type="text" name="country" required>
                <br><label for="email">Email*:</label>
                <br><input type="email" name="email" required>
                <br><label for="phone">Telefon:</label>
                <br><input type="text" name="phone">
                <br><label for="additional_info">Další informace pro dodání:</label>
                <br><input type="text" name="additional_info">
                <br>
                <input type="submit" name="submit-address" value="Pokračovat s objednávkou">
            </form>
        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>
