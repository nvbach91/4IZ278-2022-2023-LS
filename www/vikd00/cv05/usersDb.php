<?php require_once './database.php'; ?>
<?php
class UsersDB extends Database
{
    public function create($params)
    {
        echo "Created new user" . PHP_EOL;
    }

    public function fetch($id)
    {
        echo "Fetched user with ID " . $id . PHP_EOL;
    }

    public function save($id, $params)
    {
        echo "Updated user with ID " . $id . PHP_EOL;
    }

    public function delete($id)
    {
        echo "Deleted user with ID " . $id . PHP_EOL;
    }
}
