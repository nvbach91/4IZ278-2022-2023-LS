<?php

class Person {
    public function __construct(
        public $avatar,
        public $name,
        public $job,
        public $available,
        public $phone,
        public $mail,
        public $website,
        public $street,
        public $propertyNumber,
        public $orientationNumber,
        public $city,
    ){}

    public function getAddress() {
        return "$this->street $this->propertyNumber / $this->orientationNumber, $this->city";
    }

    public function getAvailability() {
        return $this->available ? 'Available for new customers' : 'Not available for new customers';
    }
}
?>