<?php
class OrderDetails extends Database{
protected $tableName = 'order_details';
public function create(array $args){}
public function fetchByOrderID($orderID)
{
    return $this->fetchBy('order_id',$orderID);
}

}
?>