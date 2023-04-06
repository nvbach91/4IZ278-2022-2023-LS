<?php 
require_once "./Database.php";
class OrdersDB extends Database{
    public function create($args) {
        echo 'Order id:', $args['id'],  ' at date: ', $args['date'], ' was created', "\r\n";

    }
    public function fetch(){
        echo 'The order was fetched', "\r\n";
    }
    public function save(){
        echo 'The order was saved', "\r\n";
    }
    public function delete(){
        echo 'The order was deleted', "\r\n";
    }
}
?>