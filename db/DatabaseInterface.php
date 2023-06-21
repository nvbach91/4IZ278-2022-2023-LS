<?php
interface DatabaseInterface {
    public function fetchAll();
    public function fetchBy($field, $value);
    public function create(array $args);
    public function deleteBy($field, $value);
    public function updateBy($conditions, $args);
}
