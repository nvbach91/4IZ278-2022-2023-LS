<?php
class Person {
    public function __construct(
        public $firstName,
        public $lastName,
        public $address,
        public $occupation,
        public $avatar,
        public $birthYear,
    ){}
        public function getFullName(){
            return $this->firstName . ' ' . $this->lastName;
        }
        public function calculateAge(){
            return date("Y") - $this->birthYear;
        }
    
}
?>