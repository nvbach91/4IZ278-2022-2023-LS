<?php
interface DatabaseOperations{
    public function create($args);
    public function fetch();
    public function save();
    public function delete();
}
?>