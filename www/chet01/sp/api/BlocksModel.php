<?php

class BlocksModel
{
    function getBlocksForDate($api, $get)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAuthenticated($api)) {
            $query = "SELECT table_id FROM blocks WHERE date = ?";
            $date = $get["date"];
            $result = $api->executeQuery($query, [$date]);
            $blocks = $result->fetchAll(PDO::FETCH_ASSOC);
            $api->sendOutput(
                json_encode($blocks),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode($blocks),
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
