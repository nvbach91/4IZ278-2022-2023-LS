<?php require_once './database.php'; ?>
<?php
class ProductsDB extends Database
{
    public function create($params)
    {
        echo "Created new product" . PHP_EOL;
    }

    public function fetch($id)
    {
        echo "Fetched product with ID " . $id . PHP_EOL;
    }

    public function save($id, $params)
    {
        echo "Updated product with ID " . $id . PHP_EOL;
    }

    public function delete($id)
    {
        echo "Deleted product with ID " . $id . PHP_EOL;
    }
}
