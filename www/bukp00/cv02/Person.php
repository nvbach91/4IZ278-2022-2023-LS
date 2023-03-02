<?php

require './utils.php';

class Person {
    public function __construct(
        public $avatar,

        public $firstName,
        public $lastName,
        public $birthDate,

        public $position,
        public $company,

        public $phone,
        public $email,
        public $web,

        public $street,
        public $orientationNumber,
        public $city,
    ) {}

    public function getFullName() {
      return "$this->firstName $this->lastName";
    }

    public function getAge() {
      return calculateAge(date('Y', $this->birthDate)) . "y.";
    }

    public function getAddress() {
        return "$this->street / $this->orientationNumber, $this->city";
    }
}
