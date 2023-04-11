<?php

require_once __DIR__ . '/../../db/config.php';
require_once __DIR__ . '/../Interfaces/InterfaceDatabaseOperations.php';

abstract class Database implements DatabaseOperations
{
    protected $db_name = DB_NAME;
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_table;
    protected $db_table_pk;
    protected $db_conn;

    public function __construct()
    {
        $this->db_conn = new PDO(
            "mysql:host=$this->db_host;dbname=$this->db_name;charset=UTF8",
            $this->db_user,
            $this->db_pass
        );

        $this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db_conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function __toString()
    {
        return "database config: path to file: $this->path, dbExtenstion: $this->ext, delimiter: $this->delimiter";
    }

    public function fetchAll()
    {
        $statement = $this->db_conn->prepare("SELECT * FROM `$this->db_table`");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetch($id)
    {
        $statement = $this->db_conn->prepare("SELECT * FROM `$this->db_table` WHERE `$this->db_table_pk` = :id");
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetchAll();
    }

    public function configInfo()
    { 
        echo $this;
    }
}