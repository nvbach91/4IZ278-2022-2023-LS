<?php

function getFullName(string $firstName, string $lastName) {
    return $firstName . ' ' . $lastName;
}

function getAge($dateStr) {
    $now = new DateTime();
    $dateTime = new DateTime($dateStr);
    $age = $now -> diff($dateTime) -> y;
    return $age;
}

function getAdress(string $country, string $city, string $street, int $houseNumber) {
    return $country . ', ' . $city . ', ' .  $street . ', ' . $houseNumber;
}
?>