<?php

class CafeModel
{
    function getCafeData($api)
    {
        $query = "SELECT * FROM cafedata";
        $result = $api->executeQuery($query);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        $api->sendOutput(
            json_encode($data),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }
    function setCafeData($api, $post)
    {
        $strErrorDesc = '';
        if (!$post['address'] || !$post['hours'] || !$post['email'] || !$post['phone']) {
            $strErrorDesc = 'Missing parameters';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else if ($api->userModel->isAdmin($api)) {
            $query = "UPDATE cafedata SET address = ?, hours = ?, email = ?, phone = ?, message = ?";
            $msg = $post['message'] ? $post['message'] : '';
            $result = $api->executeQuery($query, [$post['address'], $post['hours'], $post['email'], $post['phone'], $msg]);
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
    function getTables($api)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAdmin($api)) {
            $query = "SELECT * FROM tables";
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
                $query = "SELECT * FROM tables WHERE capacity > 0 AND id NOT IN (" . $unavailable . ")";
            } else {
                $query = "SELECT * FROM tables WHERE capacity > 0";
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
    function renameTable($api, $post)
    {
        $strErrorDesc = '';
        $query = "SELECT * from tables WHERE id = ?";
        $result = $api->executeQuery($query, [$post['id']]);
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if (!$post['id'] || !$post['name']) {
            $strErrorDesc = 'Missing parameters';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else if (!$res) {
            $strErrorDesc = 'Table not found';
            $strErrorHeader = 'HTTP/1.1 404 Not Found ';
        } else if ($api->userModel->isAdmin($api)) {
            $query = "UPDATE tables SET name = ? WHERE id = ?";
            $result = $api->executeQuery($query, [$post['name'], $post['id']]);
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
    function setTableCapacity($api, $post)
    {
        $strErrorDesc = '';
        $query = "SELECT * from tables WHERE id = ?";
        $result = $api->executeQuery($query, [$post['id']]);
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if (!$res) {
            $strErrorDesc = 'Table not found';
            $strErrorHeader = 'HTTP/1.1 404 Not Found ';
        } else if ($api->userModel->isAdmin($api)) {
            $query = "UPDATE tables SET capacity = ? WHERE id = ?";
            $result = $api->executeQuery($query, [$post['capacity'], $post['id']]);
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
}
