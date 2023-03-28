<?php

require_once __DIR__ . '/AbstractClasses/AbstractDatabase.php';

class UsersDB extends Database
{
    public function create($args)
    { 
        echo 'User ', $args['name'], ' age: ', $args['age'], ' was created', PHP_EOL; 
    }
    public function fetch()  { echo 'A user was fetched', PHP_EOL; }
    public function save()   { echo 'A user was saved  ', PHP_EOL; }
    public function delete() { echo 'A user was deleted', PHP_EOL; }
}