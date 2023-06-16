<?php
require_once "db/UserDatabase.php";
require_once "db/ReservationsDatabase.php";
session_start();

$userDb = UserDatabase::getInstance();
$reservationsDb = ReservationsDatabase::getInstance();

if (!empty($_POST["reservation"])) {
    $reservation = $_POST["reservation"];

    $reservationsDb->reserve($reservation, $userDb->getUserId($_SESSION["userEmail"]), null,
        strtotime("+1 month"));

    header("Location: index.php?reserved=1");
}
