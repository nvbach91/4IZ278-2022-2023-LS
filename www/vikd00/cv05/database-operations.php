<?php

interface DatabaseOperations
{
    public function create($params);
    public function fetch($id);
    public function save($id, $params);
    public function delete($id);
}
