<?php

interface DatabseOperations
{
    public function fetch();
    public function create($args);
    public function save();
    public function delete();
}

?>