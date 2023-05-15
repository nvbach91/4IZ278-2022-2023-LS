<?php

class ReservationModel
{
    function getReservationsForDate($api, $get)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAdmin($api)) {
            $query = "SELECT * FROM reservations WHERE date = ?";
            $date = $get["date"];
            $result = $api->executeQuery($query, [$date]);
            $reservations = $result->fetchAll(PDO::FETCH_ASSOC);
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
    function getUsersReservations($api)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAuthenticated($api)) {
            $userId = $api->userModel->getUserByToken($api, $_COOKIE['token'])['id'];
            $query = " SELECT reservations.id, reservations.table_id, tables.name, tables.capacity, reservations.date, reservations.note FROM reservations INNER JOIN tables ON reservations.table_id=tables.id WHERE user_id = ?";
            $result = $api->executeQuery($query, [$userId]);
            $reservations = $result->fetchAll(PDO::FETCH_ASSOC);
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
    function createReservation($api, $data)
    {
        $strErrorDesc = '';

        $userId = $api->userModel->getUserByToken($api, $_COOKIE['token'])['id'];
        $date = $data['date'];
        $table = $data['table'];
        $note = $data['note'] ? $data['note'] : '';

        if (!$date || !$table) {
            $strErrorDesc = 'Missing parameters';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else if ($api->userModel->isAuthenticated($api)) {
            $query = "INSERT INTO reservations (user_id, table_id, date, note) VALUES (?, ?, ?, ?)";
            $api->executeQuery($query, [$userId, $table, $date, $note]);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode(array()),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $api->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    function editReservation($api, $post)
    {
        $strErrorDesc = '';
        $userId = $api->userModel->getUserByToken($api, $_COOKIE['token'])['id'];
        $query = "SELECT * from reservations WHERE id = ?";
        $result = $api->executeQuery($query, [$post['id']]);
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if (!$res) {
            $strErrorDesc = 'Reservation not found';
            $strErrorHeader = 'HTTP/1.1 404 Not Found ';
        } else if ($api->userModel->isAdmin($api) || ($api->userModel->isAuthenticated($api) && $res['user_id'] === $userId)) {
            $query = "UPDATE reservations SET date = ?, table_id = ?, note = ? WHERE id = ?";
            $date = $api->userModel->isAdmin($api) ? $post['date'] : $res['date'];
            $result = $api->executeQuery($query, [$date, $post['table_id'], $post['note'], $post['id']]);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode(array()),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $api->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    function deleteReservation($api, $post)
    {
        $strErrorDesc = '';
        $userId = $api->userModel->getUserByToken($api, $_COOKIE['token'])['id'];
        $query = "SELECT user_id from reservations WHERE id = ?";
        $result = $api->executeQuery($query, [$post['id']]);
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if (!$res) {
            $strErrorDesc = 'Reservation not found';
            $strErrorHeader = 'HTTP/1.1 404 Not Found ';
        } else if ($api->userModel->isAdmin($api) || ($api->userModel->isAuthenticated($api) && $res['user_id'] === $userId)) {
            $query = "DELETE FROM reservations WHERE id = ?";
            $result = $api->executeQuery($query, [$post['id']]);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode(array()),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $api->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    function getTablesForDate($api, $get)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAuthenticated($api)) {
            $date = $get["date"];
            $query = "SELECT table_id FROM blocks WHERE date = ?";
            $result = $api->executeQuery($query, [$date]);
            $blocks = $result->fetchAll(PDO::FETCH_ASSOC);
            $blockedTables = array_column($blocks, 'table_id');

            $query = "SELECT table_id FROM reservations WHERE date = ?";
            $result = $api->executeQuery($query, [$date]);
            $reservations = $result->fetchAll(PDO::FETCH_ASSOC);
            $reservedTables = array_column($reservations, 'table_id');

            $unavailable = array_merge($blockedTables, $reservedTables);
            $unavailable = implode(',', $unavailable);
            if (!empty($unavailable)) {
                $query = "SELECT * FROM tables WHERE id NOT IN (" . $unavailable . ")";
            } else {
                $query = "SELECT * FROM tables";
            }
            $result = $api->executeQuery($query);
            $tables = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode($tables),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $api->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    function getCafeData($api)
    {
        $query = "SELECT * FROM cafeData";
        $result = $api->executeQuery($query);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        $api->sendOutput(
            json_encode($data),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }
}
