<?php
include 'DatabaseOperations.php';

class OrdersDB extends Database {
    public function create($args) { 
        echo 'Order no. ', $args['number'], ' was created', PHP_EOL; 
    }
    public function fetch()  { echo 'order was fetched', PHP_EOL; }
    public function save()   { echo 'order was saved  ', PHP_EOL; }
    public function delete() { echo 'order was deleted', PHP_EOL; }
}




?>