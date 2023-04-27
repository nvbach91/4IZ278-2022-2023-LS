<?php
require_once './database.php';
class ProductsDB extends Database
{
  public function create($args)
  {
    $this->save($args);
    echo 'Product ', $args['name'], ' $', $args['price'], ' was created', PHP_EOL;
  }

  public function fetch()
  {
    echo 'A product was fetched', PHP_EOL;
  }

  public function save($args)
  {
    file_put_contents($this->filePath(), $args['name'] . $this->getSeparator() . $args['price'] . PHP_EOL, FILE_APPEND);
    echo 'A product was saved  ', PHP_EOL;
  }

  public function delete()
  {
    echo 'A product cannot be deleted', PHP_EOL;
  }
}
?>