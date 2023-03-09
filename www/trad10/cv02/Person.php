<?php

class Person{
    public function __construct(
        public $firstName, 
        public $lastName, 
        public $title, 
        public $company, 
        public $avatar, 
        public $phone, 
        public $email, 
        public $website, 
        public $available, 
        public $street,
        public $propertyNumber, 
        public $orientationNumber, 
        public $city, 
        public $bankBalance, 
        public $currency) {}

    public function getAddress() {
        return "{$this->street} {$this->propertyNumber}/{$this->orientationNumber}, {$this->city}";
    }

    public function getAvailability() {
        return $this->available ? 'Not available for contracts' : 'Now available for contracts';
    }
}