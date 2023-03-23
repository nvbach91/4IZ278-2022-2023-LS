<?php
interface DatabaseOperations{
    public function create($data);
    public function fetch($id);
    public function save($id, $data);
    public function delete($id);
}
?>