<?php

class OrdersDatabase extends Database
{
    protected $tableName = 'ordereditems';
    protected $counter = 0;
    private $countRows = 0;
    public function create(array $args)
    {
        // $sql = 'INSERT INTO ' . $this->tableName . ' (product_id, product_name, price, category_id, productAmount, adress, postalCode, date, total, email, phone, name, surname) 
        //     VALUES (:product_id, :product_name, :price, :category_id, :amount, :adress, :postalCode, :date, :total, :email, :phone, :name, :surname)';

        $sql = 'INSERT INTO ' . $this->tableName . ' 
        (product_id, order_item_id, order_id, price, amount) 
            VALUES 
            (:product_id, :order_item_id, :order_id, :price, :amount)';
        $statement = $this->pdo->prepare($sql);
        if ($this->counter < 1) {
            $statement->execute([
                'order_id' => $args['order_id'],
                'product_id' => $args['product_id'],
                'order_item_id' => $this->countRow($this->tableName) + 1,
                'price' => $args['price'],
                'amount' => $args['amount'],
    
            ]);
        } else {
            $statement->execute([
                'order_id' => $this->countRows,
                'product_id' => $args['product_id'],
                'order_item_id' => $this->countRow($this->tableName) + 1,
                'price' => $args['price'],
                'amount' => $args['amount'],
            ]);
        }

        // $sql = 'INSERT INTO orders (order_id, date, user_id) 
        //     VALUES (:order_id, :date, :user_id)';
        // $statement = $this->pdo->prepare($sql);
        // if ($this->counter < 1) {
        //     $statement->execute([
        //         'order_id' => $this->countRows,
        //         'date' => date("j.m.Y - l, A"),
        //         'user_id' => $_SESSION['user']['user_id']
        //     ]);
        // }
        // $this->counter = 1;
    }
    public function fetchAllUnique()
    {
        $sql = 'SELECT DISTINCT `order_id` FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function getOrderInfo($order_id){
        $statement = $this -> pdo -> prepare('SELECT * FROM `'.$this->tableName.'` WHERE ' . 'order_id' . ' = "'.$order_id.'"' );
        $statement -> execute();
        return $statement -> fetchAll();
    }
}
