<?php

class ReservationModel
{
    function getReservationsForDate($api, $get)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAdmin($api)) {
            $query = " SELECT reservations.id, reservations.note, tables.name, tables.capacity, users.firstname, users.surname, users.email, users.phone FROM reservations INNER JOIN tables ON reservations.table_id=tables.id INNER JOIN users ON reservations.user_id = users.id WHERE date = ?";
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

        $user = $api->userModel->getUserByToken($api, $_COOKIE['token']);
        $date = $data['date'];
        $table = $data['table'];
        $note = $data['note'] ? $data['note'] : '';

        if (!$date || !$table) {
            $strErrorDesc = 'Missing parameters';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else if ($api->userModel->isAuthenticated($api)) {
            $query = "INSERT INTO reservations (user_id, table_id, date, note) VALUES (?, ?, ?, ?)";
            $api->executeQuery($query, [$user['id'], $table, $date, $note]);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            mail(
                $user['email'],
                'Your new Supercafé reservation for ' . $date,
                'Your reservation for ' . $date . ' for table #' . $table . ' was created.',
                "From: chet01@vse.cz"
            );
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
    function createAdminReservation($api, $data)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAdmin($api)) {
            $date = $data['date'];
            $table = $data['table'];
            $note = $data['note'] ? $data['note'] : '';
            $userId = $data['user'];
            if (!$date || !$table || !$userId) {
                $strErrorDesc = 'Missing parameters';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            } else {
                $query = "INSERT INTO reservations (user_id, table_id, date, note) VALUES (?, ?, ?, ?)";
                $api->executeQuery($query, [$userId, $table, $date, $note]);
            }
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            if ($userId > 1) {
                $query = "SELECT email from users WHERE id = ?";
                $userEmail = $api->executeQuery($query, [$userId])->fetch(PDO::FETCH_ASSOC);
                mail(
                    $userEmail,
                    'Your new Supercafé reservation for ' . $date,
                    'Your reservation for ' . $date . ' for table #' . $table . ' was created.',
                    "From: chet01@vse.cz"
                );
            }
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
            // $date = $api->userModel->isAdmin($api) ? $post['date'] : $res['date'];
            $date = $res['date'];
            $result = $api->executeQuery($query, [$date, $post['table_id'], $post['note'], $post['id']]);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            $query = "SELECT email from users WHERE id = ?";
            $userEmail = $api->executeQuery($query, [$res['user_id']])->fetch(PDO::FETCH_ASSOC);
            if ($userEmail) {
                mail(
                    $userEmail,
                    'Updates on your Supercafé reservation for ' . $date,
                    'Your reservation from ' . $date . ' was updated. Please check its state in your profile.',
                    "From: chet01@vse.cz"
                );
            }
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
        $query = "SELECT user_id, date from reservations WHERE id = ?";
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
            $query = "SELECT email from users WHERE id = ?";
            $userEmail = $api->executeQuery($query, [$res['user_id']])->fetch(PDO::FETCH_ASSOC);
            if ($userEmail) {
                mail(
                    $userEmail,
                    'Supercafé reservation deleted',
                    'Your reservation from ' . $res['date'] . ' was deleted.',
                    "From: chet01@vse.cz"
                );
            }
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
}
