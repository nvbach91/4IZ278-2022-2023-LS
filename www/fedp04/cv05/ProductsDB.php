<?php
include 'DatabaseOperations.php';

class ProductsDB extends Database {
    public function create($args) { 
        echo 'Product ', $args['name'], ' $', $args['price'], ' was created', PHP_EOL; 
    }
    public function fetch()  { echo 'product was fetched', PHP_EOL; }
    public function save()   { echo 'product was saved  ', PHP_EOL; }
    public function delete() { echo 'product was deleted', PHP_EOL; }
}



?>