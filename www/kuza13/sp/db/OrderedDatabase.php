<?php

class OrderedDatabase extends Database
{
protected $tableName='orders';

    public function create(array $args)
    {
        // $sql = 'INSERT INTO ' . $this->tableName . ' (product_id, product_name, price, category_id, productAmount, adress, postalCode, date, total, email, phone, name, surname) 
        //     VALUES (:product_id, :product_name, :price, :category_id, :amount, :adress, :postalCode, :date, :total, :email, :phone, :name, :surname)';
        
        $sql = 'INSERT INTO orders (order_id, user_id) 
            VALUES (:order_id, :user_id)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'order_id' =>$args['order_id'],
            'user_id'=> $args['user_id']
        ]);
       
    }
    public function fetchById( $value)
    {
        $statement = $this -> pdo -> prepare('SELECT * FROM `'.$this->tableName.'` WHERE ' . 'order_id' . ' = "'.$value.'"' );
        $statement -> execute();
        return $statement -> fetchAll();
    }
   
  
}