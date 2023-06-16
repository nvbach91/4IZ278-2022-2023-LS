<?php
require_once "db/ReservationsDatabase.php";
session_start();

$reservationsDb = ReservationsDatabase::getInstance();

if (!empty($_POST["reservation"])) {
    $reservation = explode("=", $_POST["reservation"]);

    $reservationsDb->deleteReservation($reservation[0], $reservation[1]);

    header("Location: book-queue.php?success=1");
}
