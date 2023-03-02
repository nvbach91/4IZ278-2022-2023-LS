<?php 
class Person {
    

    public function __construct(
        public $firstName,
        public $lastName,
        public $logo,
        public $title,
        public $company,
        public $email,
        public $phone,
        public $address
        ){}
         
        public function getFullName(){
            return $this->firstName . " " . $this->lastName;
        }
}


?>