<?php

class ReservationModel
{
    function getReservationsForDate($api, $date)
    {
        $strErrorDesc = '';
        if ($api->isAdmin($api)) {
            $query = "SELECT * FROM reservations WHERE date = ?";
            $result = $api->executeQuery($query, [$date]);
            $reservations = $result->fetch(PDO::FETCH_ASSOC);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode($reservations),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $api->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
