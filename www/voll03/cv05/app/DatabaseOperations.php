<?php

interface DatabaseOperations {
    public function fetchByID(int $id);
    public function fetchByName(string $name);
    public function fetchAll();
    public function create(array $record);
    public function update(int $id, array $record);
    public function delete(int $id);
    public function deleteAll();
}