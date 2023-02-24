<?php

// new in PHP 8
// PascalCase
class Person {
    // contructor promotion
    public function __construct(
        public $firstName,
        public $lastName,
        public $avatar,
        public $phone,
        public $address,
        public $birthYear,
    ) {}

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }
}