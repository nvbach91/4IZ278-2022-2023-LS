<?php require_once './Database.php'; ?>
<?php 
class UsersDB extends Database{

    public function create($data)
    {
        echo "Created new user" . PHP_EOL;
    }

    public function fetch($id)
    {
        echo "Fetched user with ID " . $id . PHP_EOL;
    }

    public function save($id, $data)
    {
        echo "Saved user with ID " . $id . PHP_EOL;
    }

    public function delete($id)
    {
        echo "Deleted user with ID " . $id . PHP_EOL;
    }
}





?>
