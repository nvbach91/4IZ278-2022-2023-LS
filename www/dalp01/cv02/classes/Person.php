<?php
/*
class Person{
    public $name;
    public $avatar;
    public $phone;
    public $address;

    public function __construct( $name, $avatar, $phone, $address ){
        $this->name = $name;
        $this->avatar = $avatar;
        $this->phone = $phone;
        $this->address = $address;
    }
}
*/

class Person{
    // constructor promotion - newly in PHP 8
    public function __construct(
        public $firstName,
        public $surname,
        public $avatar,
        public $phone,
        public $address,
        public $city,
        public $birthDate
    ) {}

    public function getAddress(){
        return $this->address . ", " . $this->city;
    }

    public function getFullName(){
        if( empty( $this->firstName ) || empty( $this->surname ) ){
            return $this->firstName . $this->surname;
        }
        return $this->firstName . ' ' . $this->surname;
    }

    public function calculateAge(){
        return ( new DateTime( $this->birthDate ) )->diff( new DateTime() )->y;
    }
}
?>