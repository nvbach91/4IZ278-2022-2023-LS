<?php



class Person {
    
    public function __construct(
        public $firstName,
        public $lastName,
        public $address,
        public $phone,
        public $avatar,
        public $birthYear
    ) {
    }
    public function getFullName() {
        $fullName = $this->firstName . ' ' . $this->lastName;
        return $fullName;
    }
}