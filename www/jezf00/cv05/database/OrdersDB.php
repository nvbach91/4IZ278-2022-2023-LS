<?php
class OrdersDB extends Database
{
  public function create($args)
  {
    echo 'Order no. ', $args['number'], ' was created', PHP_EOL;
    $this->save($args);
  }

  public function fetch()
  {
    echo 'An order was fetched', PHP_EOL;
  }

  public function save($args)
  {
    file_put_contents($this->filePath(), $args['number'] . PHP_EOL, FILE_APPEND);
    echo 'An order was saved  ', PHP_EOL;
  }

  public function delete()
  {
    echo 'An order cannot be deleted', PHP_EOL;
  }
}
?>
