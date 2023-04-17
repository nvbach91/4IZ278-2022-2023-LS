<?php
require_once "Database.php";

class UsersDB extends Database {

    public function create($args): void {
        echo 'User ', $args['name'], ' age: ', $args['age'], ' was created', PHP_EOL;
    }

    public function fetch(): void {
        echo 'A user was fetched', PHP_EOL;
    }

    public function save(): void {
        echo 'A user was saved', PHP_EOL;
    }

    public function delete(): void {
        echo 'A user was deleted', PHP_EOL;
    }
}
