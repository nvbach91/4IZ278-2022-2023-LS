<?php
require_once "../db/UserDatabase.php";
require_once "../db/LoansDatabase.php";
session_start();

if (($_SESSION["userType"] ?? 0) < 2) header("Location: ../index.php");

$userDb = UserDatabase::getInstance();
$loansDb = LoansDatabase::getInstance();

$email = $_SESSION["manageEmail"];
$overpay = false;

if (!empty($_POST["isbn"])) {
    $isbn = trim($_POST["isbn"]);
    $returned = $loansDb->return($userDb->getUserId($email), $isbn);

    if (!$returned) $loansDb->borrow($userDb->getUserId($email), $isbn, null, strtotime("+1 month"));
}

if (!empty($_POST["pay"])) $overpay = !$userDb->payDebt($userDb->getUserId($email), $_POST["pay"]);

header("Location: ../branch.php?email=$email&overpay=$overpay");
