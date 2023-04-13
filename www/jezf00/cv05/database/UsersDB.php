<?php
class UsersDB extends Database
{
  public function create($args)
  {
    $this->save($args);
    echo 'User ', $args['name'], ' age: ', $args['age'], ' was created', PHP_EOL;
  }

  public function fetch()
  {
    echo 'A user was fetched', PHP_EOL;
  }

  public function save($args)
  {
    file_put_contents($this->filePath(), $args['name'] . $this->getSeparator() . $args['age'] . PHP_EOL, FILE_APPEND);
    echo 'A user was saved  ', PHP_EOL;
  }

  public function delete()
  {
    echo 'A user cannot be deleted', PHP_EOL;
  }
}
?>