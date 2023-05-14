<?php

namespace model;
class Database //třída pro komunikaci s databází
{
    //nastavení propojení s databází
    const HOST = "";
    const DNAME = "";
    const USER = "";
    const PASS = "";

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DNAME,
            self::USER,
            self::PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
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