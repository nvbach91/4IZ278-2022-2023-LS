<?php

interface DatabaseOperations
{
    public function fetch($id);
    public function create($args);
    public function update($id, $args);
    public function delete($id);
}