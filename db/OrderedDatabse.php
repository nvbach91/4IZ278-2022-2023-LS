<?php
class OrderedDatabase extends Database
{
protected $tableName='orders';

    public function create(array $args)
    {
        // $sql = 'INSERT INTO ' . $this->tableName . ' (product_id, product_name, price, category_id, productAmount, adress, postalCode, date, total, email, phone, name, surname) 
        //     VALUES (:product_id, :product_name, :price, :category_id, :amount, :adress, :postalCode, :date, :total, :email, :phone, :name, :surname)';
        
        $sql = 'INSERT INTO orders (order_id, date, user_id) 
            VALUES (:order_id, :date, :user_id)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'order_id' => $countRows=$this->countRow('orders')+1,
            'date' => date("j.m.Y - l, A"),
            'user_id'=> $_SESSION['user']['user_id']
        ]);
        $sql = 'INSERT INTO ' . $this->tableName . ' 
        (product_id, order_item_id, order_id, price, amount) 
            VALUES 
            (:product_id, :order_item_id, :order_id, :price, :amount)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'product_id' => $args['product_id'],
            'order_item_id' => $this->countRow($this->tableName)+1,
            'order_id' => $countRows,
            // 'product_name' => $args['product_name'],
            'price' => $args['price'],
            // 'category_id' => $args['category_id'],
            'amount' => $args['amount'],
            // 'name'=>$args['name'],
            // 'surname'=>$args['surname'],
            // 'email'=>$args['email'],
            // 'adress' => $args['adress'],
            // 'postalCode' => $args['postalCode'],
            // 'phone' => $args['phone'],
            // 'total' => $args['total'],
            // 'date' => $args['date']=date("j.m.Y - l, A")
        ]);
    }
    public function getOrderInfo($order_id){

    }
  
}