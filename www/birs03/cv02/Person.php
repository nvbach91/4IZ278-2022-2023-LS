<?php
class Person {
    
    public function __construct(
        public $firstName,
        public $lastName,
        public $avatar,
        public $phone,
        public $address,
        public $birthDate
    ){}

    public function getFullName(){
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getAge(){
        return floor((time() - strtotime($this->birthDate)) / 31556926);
    }
    
}
?>