<?php
require 'item.php';
require "database.php";
class ShoppingCart
{

    private $items = [];
    public function addProduct($id, $amount)
    {
        $item = new Item($id, $amount);
        $this->items[$id] = $item;
    }
    public function removeProduct($id)
    {
        unset($this->items[$id]);
    }
    public function changeAmount($id, $amount)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]->setAmount($amount);
        }
    }
    public function getAmount($id)
    {
        return $this->items[$id]->getAmount();
    }
    public function emptyCart()
    {
        $this->items = [];
    }
    public function getIds()
    {
        return array_keys($this->items);
    }
    public function showCart()
    {
        if(empty($this->items)){
            return;
        }
        $questionMarks="";
        foreach(array_keys($this->items) as $itemId){
            $questionMarks .= "?,";
        }
        $questionMarks = trim($questionMarks,",");
        $database = new Database();
        $query = "SELECT * FROM products WHERE product_id IN ($questionMarks)";
        $params = array_keys($this->items);
        $result = $database->queryGet($query, $params);
        return $result;
    }
}
