<?php
class Item{
    public function __construct($id, $amount)
    {
        $this->id=$id;
        $this->amount=$amount;
    }
    public function getId(){
        return $this->id;
    }
    public function getAmount(){
        return $this->amount;
    }
    public function setAmount($amount){
        $this->amount=$amount;
    }
    private $id;
    private $amount;
}