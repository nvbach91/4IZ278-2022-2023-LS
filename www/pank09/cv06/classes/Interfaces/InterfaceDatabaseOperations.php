<?php

interface DatabaseOperations
{
    public function fetch($id);
    public function create($args);
    public function save();
    public function delete();
}