<?php
interface DatabaseOperations
{
  public function fetch();
  public function create($args);
  public function save($args);
  public function delete();
}
?>