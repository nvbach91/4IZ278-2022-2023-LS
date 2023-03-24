<?php
include 'DatabaseOperations.php';

class UsersDB extends Database {
    public function create($args) { 
        echo 'User ', $args['name'], ' age: ', $args['age'], ' was created', PHP_EOL; 
    }
    public function fetch()  { echo 'user was fetched', PHP_EOL; }
    public function save()   { echo 'user was saved  ', PHP_EOL; }
    public function delete() { echo 'user was deleted', PHP_EOL; }}

    $users = new UsersDB();




?>