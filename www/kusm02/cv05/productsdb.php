<?php
class ProductsDB extends Database {
    public function create($args) { 
        echo 'Product ', $args['name'], ' $', $args['price'], ' was created', PHP_EOL . '<br>'; 
    }
    public function fetch()  { echo 'A product was fetched', PHP_EOL; }
    public function save()   { echo 'A product was saved  ', PHP_EOL; }
    public function delete() { echo 'A product was deleted', PHP_EOL; }
}
?>