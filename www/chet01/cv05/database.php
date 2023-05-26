<?php
const DB_SERVER_URL = "localhost";
const DB_USERNAME = "root";
const DB_PASSWORD = "";
const DB_DATABASE = "chet01";

interface DatabaseOperations
{
    public function fetch();
    public function create();
    public function save();
    public function delete();
}
abstract class Database implements DatabaseOperations
{
    protected $connection;
    protected function query($query)
    {
        $result = $this->connection->query($query);
        if ($result) {
            return $result->fetch_assoc();
        }
        return [];
    }
    public function __construct()
    {
        $this->connection = new mysqli(
            DB_SERVER_URL,
            DB_USERNAME,
            DB_PASSWORD,
            DB_DATABASE
        );
        if ($this->connection->connect_error) {
            exit("Connection to DB failed: " . $this->connection->connect_error);
        }
    }
}
class UsersDB extends Database
{
    public function create()
    {
        echo 'User was created', PHP_EOL;
    }
    public function fetch()
    {
        echo 'User was fetched', PHP_EOL;
    }
    public function save()
    {
        echo 'User was saved  ', PHP_EOL;
    }
    public function delete()
    {
        echo 'User was deleted', PHP_EOL;
    }
}
