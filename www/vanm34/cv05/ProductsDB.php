<?php require_once './database.php'; ?>
<?php


class ProductsDB extends Database{
    public function create($data)
    {
        echo "Created new product" . PHP_EOL;
    }

    public function fetch($id)
    {
        echo "Fetched product with ID " . $id . PHP_EOL;
    }

    public function save($id, $data)
    {
        echo "Saved product with ID " . $id . PHP_EOL;
    }

    public function delete($id)
    {
        echo "Deleted product with ID " . $id . PHP_EOL;
    }
}