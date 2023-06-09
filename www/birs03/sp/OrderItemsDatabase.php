<?php require_once 'Database.php';?>
<?php 

class OrderItemsDatabase extends Database{

    function addOrderItem($order_id,$product_id,$name,$quantity,$price){
        $statement=$this->pdo->prepare("INSERT INTO order_items (order_id,product_id,name,quantity,price) VALUES (?,?,?,?,?)");
        $statement->execute([$order_id,$product_id,$name,$quantity,$price]);
    }

    function getOrderItemById($id){
        $statement=$this->pdo->prepare("SELECT * FROM order_items WHERE order_id = $id");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}

?>