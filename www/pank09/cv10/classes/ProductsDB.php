<?php

require_once __DIR__ . '/AbstractClasses/AbstractDatabase.php';

class ProductsDB extends Database
{
    protected $db_table = 'cv09_goods';
    protected $db_table_pk = 'good_id';

    public function create($args) {
        $statement = $this->db_conn->prepare("INSERT INTO `$this->db_table` (`name`, `price`, `description`, `img`) VALUES (:name, :price, :description, :img)");
        $statement->execute($args);
    }

    public function fetchAll($offset = 0, $limit = 10)
    {
        $statement = $this->db_conn->prepare("SELECT * FROM `$this->db_table` LIMIT :offset, :limit");
        $statement->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $statement->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function update($id, $args)
    {
        $statement = $this->db_conn->prepare("UPDATE `$this->db_table` SET `name` = :name, `price` = :price, `description` = :description, `img` = :img WHERE `$this->db_table_pk` = :id");
        $args['id'] = $id;
        return $statement->execute($args);
    }

    public function getTotalProducts() {
        return $this->db_conn
                    ->query("SELECT count(*) FROM $this->db_table")
                    ->fetchColumn();
    }
    
    public function getTotalPages($limit = 10) {
        return ceil($this->getTotalProducts() / $limit);
    }
}