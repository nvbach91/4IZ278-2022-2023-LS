<?php
class OrdersDatabse extends Database
{
protected $tableName='orders';

    public function create(array $args)
    {
        $sql = 'INSERT INTO ' . $this->tableName . ' (product_id, product_name, price, category_id, productAmount, adress, postalCode, date, total, email, phone, name, surname) 
            VALUES (:product_id, :product_name, :price, :category_id, :productAmount, :adress, :postalCode, :date, :total, :email, :phone, :name, :surname)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'product_id' => $args['product_id'],
            'product_name' => $args['product_name'],
            'price' => $args['price'],
            'category_id' => $args['category_id'],
            'productAmount' => $args['productAmount'],
            'name'=>$args['name'],
            'surname'=>$args['surname'],
            'email'=>$args['email'],
            'adress' => $args['adress'],
            'postalCode' => $args['postalCode'],
            'phone' => $args['phone'],
            'total' => $args['total'],
            'date' => $args['date']=date("j.m.Y - l, A")
        ]);
    }
}
