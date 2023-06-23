<?php
require_once "database.php";
require_once "cart.php";
require_once "address.php";
class Order
{
    public function GetAllOrders()
    {
        $database = new Database();
        $query = "SELECT `orders`.`order_id`,`date`,`status`,`total_price` FROM `orders` 
        JOIN `order_status` ON `last_status`=`order_status_id`
        ORDER BY `date` DESC;";
        return $database->queryGet($query, array());
    }
    public function GetUserIdFromOrderId($orderId)
    {
        $database = new Database();
        $query = "SELECT `user_id` FROM `orders` WHERE `order_id`=?";
        $params = array($orderId);
        $result = $database->queryGet($query, $params);
        return $result[0]['user_id'];
    }
    public function GetUserOrders($userId)
    {
        $database = new Database();
        $query = "SELECT `orders`.`order_id`,`date`,`status`,`total_price` FROM `orders` 
        JOIN `order_status` ON `last_status`=`order_status_id`
        WHERE `user_id`=?
        ORDER BY `date` DESC;";
        $params = array($userId);
        return $database->queryGet($query, $params);
    }
    public function GetOrderAddress($orderId)
    {
        $database = new Database();
        $query = "SELECT * FROM `orders` 
        JOIN `address` ON `orders`.`address_shipping`=`address`.`address_id`
        WHERE `order_id`=?";
        $params = array($orderId);
        $result = $database->queryGet($query, $params);
        $address = new Address();
        $address->name = $result[0]['name'];
        $address->street = $result[0]['street'];
        $address->zip = $result[0]['zip'];
        $address->city = $result[0]['city'];
        $address->country = $result[0]['country'];
        $address->email = $result[0]['email'];

        $address->additional_info = $result[0]['additional_info'];
        $address->phone = $result[0]['phone'];

        return $address;
    }
    public function GetOrderProducts($orderId)
    {
        $database = new Database();
        $query = "SELECT *,`order_products`.`price` AS `current_price` FROM `order_products` 
        JOIN `products` USING (`product_id`)
        WHERE `order_id`=?";
        $params = array($orderId);
        $result = $database->queryGet($query, $params);
        //var_dump($result);
        return $result;
    }
    public function GetOrderStatus($orderId)
    {
        $database = new Database();
        $query = "SELECT * FROM `order_status` WHERE `order_id`=?
        ORDER BY `date` DESC;";
        $params = array($orderId);
        $result = $database->queryGet($query, $params);
        return $result;
    }
    public function AddOrderStatus($orderId,$status,$information)
    {
        $database = new Database();
        $query = "SELECT COUNT(order_status_id) FROM `order_status`";
        $result = $database->queryGet($query, array());
        $orderStatusId = $result[0]["COUNT(order_status_id)"];

        $query = "INSERT INTO `order_status`(`order_status_id`, `date`, `status`, `information`, `order_id`) VALUES (?,?,?,?,?)";
        $params = array($orderStatusId, date('Y-m-d H:i:s'), $status, $information, $orderId);
        $database->querySet($query, $params);

        $query = "UPDATE `orders` SET `last_status`=? WHERE `order_id`=?";
        $params = array($orderStatusId, $orderId);
        $database->querySet($query, $params);
        return $result;
    }
    public function CreateOrder(&$cart, &$address)
    {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
        } else {
            $userId = NULL;
        }
        $database = new Database();
        $query = "SELECT address_id FROM `address` WHERE `name` = ? AND `zip` = ? AND `country` = ? AND `city` = ? AND `street` = ? AND `additional_info` = ? AND `email` = ? AND `phone` = ? AND `user_id` = ?";
        $params = array(
            $address->name, $address->zip, $address->country,
            $address->city, $address->street, $address->additional_info, $address->email,
            $address->phone, $userId
        );
        $result = $database->queryGet($query, $params);
        if (empty($result)) {
            $query = "SELECT COUNT(address_id) FROM `address`";
            $result = $database->queryGet($query, array());
            $addressId = $result[0]["COUNT(address_id)"];
            $query = "INSERT INTO `address`
        (`address_id`, `name`, `zip`, `country`, `city`, `street`, `additional_info`
        , `email`, `phone`,`user_id`)
         VALUES (?,?,?,?,?,?,?,?,?,?)";
            $params = array(
                $addressId, $address->name, $address->zip, $address->country,
                $address->city, $address->street, $address->additional_info, $address->email,
                $address->phone,$userId
            );
            $database->querySet($query, $params);
        } else {
            $addressId = $result[0]["address_id"];
        }
        $query = "SELECT COUNT(order_id) FROM `orders`";
        $result = $database->queryGet($query, array());
        $orderId = $result[0]["COUNT(order_id)"];
        


        $query = "INSERT INTO `orders`(`order_id`, `user_id`, `address_shipping`, `address_billing`) VALUES (?,?,?,?)";
        $params = array($orderId, $userId, $addressId, $addressId);
        $database->querySet($query, $params);

        $query = "SELECT COUNT(order_status_id) FROM `order_status`";
        $result = $database->queryGet($query, array());
        $orderStatusId = $result[0]["COUNT(order_status_id)"];

        $query = "INSERT INTO `order_status`(`order_status_id`, `date`, `status`, `information`, `order_id`) VALUES (?,?,?,?,?)";
        $params = array($orderStatusId, date('Y-m-d H:i:s'), 'Vytvoření objednávky', 'Vytvoření objednávky', $orderId);
        $database->querySet($query, $params);

        $cartproducts = $cart->showCart();
        $totalPrice = 0;
        foreach ($cartproducts as $cartproduct) {
            $productId = $cartproduct['product_id'];
            $price = $cartproduct['price'];
            $amount = $cart->getAmount($productId);
            $totalPrice += ($price * $amount);
            $stock = $cartproduct['stock'];
            $query = "INSERT INTO `order_products`(`price`, `amount`, `order_id`, `product_id`) VALUES (?,?,?,?)";
            $params = array($price, $amount, $orderId, $productId);
            $database->querySet($query, $params);

            $query = "UPDATE `products` SET `stock`=? WHERE `product_id`=?";
            $params = array($stock - $amount, $productId);
            $database->querySet($query, $params);
        }
        $query = "UPDATE `orders` SET `last_status`=?,`total_price`=? WHERE `order_id`=?";
        $params = array($orderStatusId, $totalPrice, $orderId);
        $database->querySet($query, $params);

        $cart->emptyCart();
    }
}
