<?php
require_once(__DIR__.'/Database.php');
require_once(__DIR__.'/ProductsDB.php');

//Class uses singleton pattern and so delegates its instance creation to getDatabase method. Class works with sp_users database
class OrdersDB
{
    private $lastInsertedId = 0;
    private $pdo;
    static $ordersDB;
    private final function __construct()
    {
        $db = Database::getDatabase();
        $this->pdo = $db->getPdo();
    }

    //Fuction that creates or just shares class instance depending whether it has already been initialized or not. Returns class instance.
    public static function getDatabase()
    {
        if (!isset($ordersDB)) {
            self::$ordersDB = new OrdersDB;
        }
        return self::$ordersDB;
    }

    //Function that places order. Sends user_id, items (in a format equivalent to the one used for $_SESSION['books']), order_address and orderDate. Returns null is successful, otherwise send error
    function placeOrder($user_id, $items, $orderAddress, $orderDate)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO sp_orders (order_date, order_user_id, order_address) VALUES (:order_date, :order_user_id, :order_address)");
            $statement->execute([':order_date' => htmlspecialchars($orderDate), ':order_user_id' => htmlspecialchars($user_id), ':order_address' => htmlspecialchars($orderAddress)]);
            $lastInsertedId = $this->pdo->lastInsertId();
            $productsDB = ProductsDB::getDatabase();
            foreach ($items as $item) {
                $statement = $this->pdo->prepare("INSERT INTO sp_order_item (price, amount, order_item_order_id, order_item_book_id) VALUES (:price, :amount, :order_id, :book_id)");
                $statement->execute([
                    ':price' => (float)$productsDB->getBook(htmlspecialchars($item['book_id']))['price']*$item['book_count'],
                    ':amount' => $item['book_count'],
                    ':order_id' => $lastInsertedId,
                    ':book_id' => htmlspecialchars($item['book_id'])
                ]);
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    //Function that returns user_id's orders
    function getUsersOrders($user_id){
        try{
            $statement=$this->pdo->prepare("SELECT * FROM sp_orders WHERE order_user_id=:user_id ORDER BY order_id DESC");
            $statement->execute([
                ':user_id'=>htmlspecialchars($user_id)
            ]);
            $result=$statement->fetchAll();
            return $result;
        }catch(PDOException $e){
            return $e;
        }
    }

    //Function that returns order items from an order with order_id
    function getOrderItems($order_id){
        try{
            $statement=$this->pdo->prepare("SELECT * FROM sp_order_item WHERE order_item_order_id=:order_id");
            $statement->execute([
                ':order_id'=>htmlspecialchars($order_id)
            ]);
            $result=$statement->fetchAll();
            return $result;
        }catch(PDOException $e){
            return $e;
        }
    }

    //Function for order deletion. Not implemented yet
    function deleteOrder($order_id)
    {
    }
}
