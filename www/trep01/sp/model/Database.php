<?php
class Database //třída pro komunikaci s databází
{
    //nastavení propojení s databází

    private $host;
    private $dname;
    private $user;
    private $pass;

    private $conn;

    public function __construct()
    {
        $config = include('databaseConfig.php'); // nahraďte správnou cestou k souboru config.php

        $this->host = $config['db_host'];
        $this->dname = $config['db_name'];
        $this->user = $config['db_user'];
        $this->pass = $config['db_pass'];

        $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dname,
            $this->user,
            $this->pass,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);
        $this->conn->query("SET NAMES utf8");
    }

    private function execute($query, $params = []) //spouští sql dotazy
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function select($sql, $params = []) //vybere pole z databáze
    {
        $stmt = $this->execute($sql, $params);

        return $stmt->fetchAll();
    }

    public function selectOne($sql, $params = []) //vybere 1 položku z databáze
    {
        $stmt = $this->execute($sql, $params);

        return $stmt->fetch();
    }

    public function update($sql, $params = []) //upraví položku v databázi
    {
        $stmt = $this->execute($sql, $params);

        return $stmt->rowCount();
    }

    public function insert($sql, $params = []) //vloží do databáze
    {
        $stmt = $this->execute($sql, $params);

        return $this->conn->lastInsertId();
    }

    public function delete($sql, $params = []) //smaže z databáze
    {
        $stmt = $this->execute($sql, $params);

        //return;
    }

}