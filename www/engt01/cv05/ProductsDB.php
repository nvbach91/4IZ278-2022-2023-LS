<?php
require_once "Database.php";

class ProductsDB extends Database {

    public function create($args): void {
        echo 'Product ', $args['name'], ' $', $args['price'], ' was created', PHP_EOL;
    }

    public function fetch(): void {
        echo 'A product was fetched', PHP_EOL;
    }

    public function save(): void {
        echo 'A product was saved', PHP_EOL;
    }

    public function delete(): void {
        echo 'A product was deleted', PHP_EOL;
    }
}
