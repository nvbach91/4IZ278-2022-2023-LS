<?php 
require_once "./Database.php";
class ProductsDB extends Database{
    public function create($args) {
        echo 'Product:', $args['name'] ,', ', 'price: ', $args['price'] , ', ', 'was created ', "\r\n";

    }
    public function fetch(){
        echo 'The product was fetched', "\r\n";
    }
    public function save(){
        echo 'The product was saved', "\r\n";
    }
    public function delete(){
        echo 'The product was deleted', "\r\n";
    }
}
?>