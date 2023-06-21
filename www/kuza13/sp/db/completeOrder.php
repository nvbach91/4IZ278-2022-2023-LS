<?php
class completeOrder extends Database{
    protected $tableName = 'ordereditems';

    public function create(array $args)  { }

public function completeOrder($orderID){
    return $this->deleteBy('order_id',$orderID);
}


}