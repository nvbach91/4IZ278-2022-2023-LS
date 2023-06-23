<?php
require_once "../db/ReservationsDatabase.php";
session_start();

if (($_SESSION["userType"] ?? 0) < 3) header("Location: ../index.php");

$reservationsDb = ReservationsDatabase::getInstance();

if (!empty($_POST["reservation"])) {
    $reservation = explode("=", $_POST["reservation"]);

    $reservationsDb->deleteReservation($reservation[0], $reservation[1]);

    header("Location: ../book-queue.php?success=1");
}
