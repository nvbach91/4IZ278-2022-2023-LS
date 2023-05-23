<?php

class BlocksModel
{
    function getAllBlocks($api)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAdmin($api)) {
            $query = "SELECT blocks.id, tables.name, tables.id as table_id, tables.capacity, blocks.date, blocks.note FROM blocks INNER JOIN tables ON blocks.table_id=tables.id ORDER BY blocks.date DESC";
            $result = $api->executeQuery($query);
            $blocks = $result->fetchAll(PDO::FETCH_ASSOC);
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
    function createBlock($api, $data)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAdmin($api)) {
            $date = $data['date'];
            $table = $data['table'];
            $note = $data['note'] ? $data['note'] : '';
            if (!$date || !$table) {
                $strErrorDesc = 'Missing parameters';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            } else {
                $query = "INSERT INTO blocks ( table_id, date, note) VALUES (?, ?, ?)";
                $api->executeQuery($query, [$table, $date, $note]);
            }
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
    function editBlock($api, $post)
    {
        $strErrorDesc = '';
        $query = "SELECT * from blocks WHERE id = ?";
        $result = $api->executeQuery($query, [$post['id']]);
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if (!$post['table_id'] || !$post['note'] || !$post['id']) {
            $strErrorDesc = 'Missing parameters';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else if (!$res) {
            $strErrorDesc = 'Block not found';
            $strErrorHeader = 'HTTP/1.1 404 Not Found ';
        } else if ($api->userModel->isAdmin($api)) {
            $query = "UPDATE blocks SET table_id = ?, note = ? WHERE id = ?";
            $result = $api->executeQuery($query, [$post['table_id'], $post['note'], $post['id']]);
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
    function deleteBlock($api, $post)
    {
        $strErrorDesc = '';
        $query = "SELECT * from blocks WHERE id = ?";
        $result = $api->executeQuery($query, [$post['id']]);
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if (!$res) {
            $strErrorDesc = 'Block not found';
            $strErrorHeader = 'HTTP/1.1 404 Not Found ';
        } else if ($api->userModel->isAdmin($api)) {
            $query = "DELETE FROM blocks WHERE id = ?";
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
}
