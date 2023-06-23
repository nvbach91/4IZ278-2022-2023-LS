<?php
require_once "Database.php";

class OrdersDatabase extends Database
{
    public function fetchAll()
    {
        $query = "SELECT * FROM `Order`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function createOrder($date, $price, $userid, $shipping, $paymenttype)
    {
        $query = "INSERT `Order` (date, price, user_userid, shipping, paymenttype) 
        VALUES(?,?,?,?,?);";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $date);
        $statement->bindParam(2, $price);
        $statement->bindParam(3, $userid);
        $statement->bindParam(4, $shipping);
        $statement->bindParam(5, $paymenttype);
        $statement->execute();
    }

    public function getLastID()
    {
        $query = "SELECT orderid FROM `Order` ORDER BY orderid DESC LIMIT 1;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        return $result["orderid"];
    }

    public function createOrderItem($quantity, $price, $orderid, $itemid, $itemname)
    {
        $query = "INSERT ordereditem (quantity, price, order_orderid, item_itemid, itemname) 
        VALUES(?,?,?,?,?);";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $quantity);
        $statement->bindParam(2, $price);
        $statement->bindParam(3, $orderid);
        $statement->bindParam(4, $itemid);
        $statement->bindParam(5, $itemname);
        $statement->execute();
    }

    public function getUsersOrders($id)
    {
        $query = "SELECT * FROM `Order` where user_userid=? ORDER BY orderid DESC;";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getOrderedItems($orderID)
    {
        $query = "SELECT * FROM ordereditem where order_orderid=?;";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $orderID);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUsersOrdersAmount($id)
    {
        $query = "SELECT COUNT(*) AS count FROM `Order` WHERE user_userid=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        $result = $statement->fetchAll()[0]["count"];
        return $result;
    }
    public function fetchPage($userid, $itemsCountPerPage, $offset)
    {
        $query = "SELECT * FROM `Order` WHERE user_userid=? ORDER BY orderid DESC LIMIT $itemsCountPerPage
        OFFSET ?;";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $userid);
        $statement->bindParam(2, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}
