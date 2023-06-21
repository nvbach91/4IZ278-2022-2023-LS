<?php

require_once "Database.php";

class ItemsDatabase extends Database
{

    public function fetchAll()
    {
        $query = "SELECT * FROM item";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetch($id)
    {
        $query = "SELECT * FROM item where itemid=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        return $statement->fetch();
    }

    public function containsItem($id)
    {
        $query = "SELECT * FROM item where itemid=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        $result = $statement->fetch();
        if (count($result) == 0) return false;
        return true;
    }

    public function changeItemInfo($id, $name, $price, $description, $image, $category)
    {
        $query = "UPDATE item
                SET name=?, price=?, description=?, image=?, category_categoryid=?
                WHERE itemid = ?;";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $name);
        $statement->bindParam(2, $price);
        $statement->bindParam(3, $description);
        $statement->bindParam(4, $image);
        $statement->bindParam(5, $category);
        $statement->bindParam(6, $id);
        $statement->execute();
    }

    public function getItemsAmount()
    {
        $query = "SELECT COUNT(*) AS count FROM item";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll()[0]["count"];
        return $result;
    }

    public function fetchPage($itemsCountPerPage, $offset)
    {
        $query = "SELECT * FROM item ORDER BY itemid ASC LIMIT $itemsCountPerPage
        OFFSET ?;";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function removeItem($id)
    {
        $query = "DELETE FROM item WHERE itemid=?;";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
    }

    public function addItem($name, $price, $description, $image, $category)
    {
        $query = "INSERT item (name, price, description, image, category_categoryid) VALUES(?,?,?,?,?);";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $name);
        $statement->bindParam(2, $price);
        $statement->bindParam(3, $description);
        $statement->bindParam(4, $image);
        $statement->bindParam(5, $category);
        $statement->execute();
    }
}
