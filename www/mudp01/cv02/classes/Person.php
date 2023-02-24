<?php
class Person{
    public $pronePrefix;
    public $phone;
    public $age;
    
    public function __construct( public $name, public $profession, $pronePrefix, $phone, public $adress, public $psc, public $email, public $avatarAdress, $bornDate)
    {
        $this-> phone = $phone;
        $this-> pronePrefix = $pronePrefix;
        $this-> age = $this->getAge($bornDate);
    }

    public function getFullPhone(){
        $fullPhone = $this->pronePrefix . ' ' . $this->phone; 
        return $fullPhone;
    }

    public function getFullAdress(){
        $fullAdress = $this->adress . ', ' . $this->psc; 
        return $fullAdress;
    }

    private function getAge($bornDate){
        return date("Y") - $bornDate;;
    }
}
?>