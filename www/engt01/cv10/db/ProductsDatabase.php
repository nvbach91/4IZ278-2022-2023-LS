<?php
require_once "Database.php";

class ProductsDatabase extends Database {
    public function fetchAll(int $pageSize, int $offset): false|array {
        if ($pageSize < 1 || $offset < 0) return false;

        $query = "SELECT * FROM cv09_goods ORDER BY good_id DESC LIMIT :page_size OFFSET :offset";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':page_size', $pageSize, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getCount(): int|false {
        $query = "SELECT count(good_id) AS `count` FROM cv09_goods";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll()[0]["count"];
    }

    public function exists(int $id): bool {
        $query = "SELECT * FROM cv09_goods WHERE good_id = :good_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':good_id', $id, PDO::PARAM_INT);
        $statement->execute();
        return !empty($statement->fetchAll());
    }

    public function fetch(int $id) {
        $query = "SELECT * FROM cv09_goods WHERE good_id = :good_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':good_id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll()[0];
    }

    public function add($name, $desc, $price, $img): false|array {
        $query = "INSERT INTO cv09_goods (name,description,price,img) VALUES (:name, :desc, :price, :img)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':desc', $desc);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':img', $img);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function edit($gid, $name, $desc, $price, $img): false|array {
        $query = "UPDATE cv09_goods SET name = :name, description = :desc, price = :price, img = :img  WHERE good_id = :good_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':good_id', $gid);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':desc', $desc);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':img', $img);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function delete(int $gid): false|array {
        $query = "DELETE FROM cv09_goods WHERE good_id = :good_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':good_id', $gid, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}
