<?php 

interface DatabaseOperations {
    public function fetch($id);
    public function create($args);
    public function save($id, $args);
    public function delete($id, $args);
} 

?>