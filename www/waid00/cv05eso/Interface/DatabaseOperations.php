<?php

interface DatabaseOperations {
    public function create($data);
    public function fetch($id);
    public function save($id, $name, $email);
    public function delete($id);
}
