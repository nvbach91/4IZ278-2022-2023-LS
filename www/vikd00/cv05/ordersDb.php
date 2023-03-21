<?php require_once './database.php'; ?>
<?php
class OrdersDB extends Database
{
    public function create($params)
    {
        echo "Created new order" . PHP_EOL;
    }

    public function fetch($id)
    {
        echo "Fetched order with ID " . $id . PHP_EOL;
    }

    public function save($id, $params)
    {
        echo "Updated order with ID " . $id . PHP_EOL;
    }

    public function delete($id)
    {
        echo "Deleted order with ID " . $id . PHP_EOL;
    }
}
