<?php 
interface DatabaseInterface {
    public function fetchAll();
    public function fetchBy($field, $value);
    public function create($args);
    public function deleteBy($field, $value);
    public function updateBy($conditions, $args);
    public function query($sql, $args);
}
?>