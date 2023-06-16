<?php
interface DatabaseFunctions {
    public function getByID($args);
    public function insert($args);
    public function update($args, $args2);
    public function delete($args);
}