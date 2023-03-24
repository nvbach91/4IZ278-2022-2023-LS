<?php 
require_once "./Database.php";
class UsersDB extends Database{
    public function create($args) {
        echo 'User:', $args['name'], ',',' age: ', $args['age'], ' was created ', "\r\n";

    }
    public function fetch(){
        echo 'The user was fetched', "\r\n";
    }
    public function save(){
        echo 'The user was saved', "\r\n";
    }
    public function delete(){
        echo 'The user was deleted', "\r\n";
    }
}
?>