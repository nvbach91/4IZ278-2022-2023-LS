<?php
require_once "Database.php";

class OrdersDB extends Database {

    public function create($args): void {
        echo 'Order no. ', $args['number'], ' was created', PHP_EOL;
    }

    public function fetch(): void {
        echo 'An order was fetched', PHP_EOL;
    }

    public function save(): void {
        echo 'An order was saved', PHP_EOL;
    }

    public function delete(): void {
        echo 'An order was deleted', PHP_EOL;
    }
}
