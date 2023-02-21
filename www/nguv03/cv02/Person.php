<?php

class Person {
    public function __construct(
        public $avatar, // PHP 8 constructor promotion
        public $firstName,
        public $lastName,
        public $title,
        public $company,
        public $available,
        public $phone,
        public $email,
        public $website,
        public $street,
        public $propNumber,
        public $orientationNumber,
        public $city,
    ) {}

    public function getAddress() {
        return "$this->street $this->propNumber / $this->orientationNumber, $this->city";
    }

    public function getAvailability() {
        return $this->available ? 'Not available for contracts' : 'Now available for contracts';
    }
}

/*
// PHP 7
class Person {
    public $avatar;
    public $firstName;
    public $lastName;
    public $title;
    public $company;
    public $available;
    public $phone;
    public $email;
    public $website;
    public $street;
    public $propNumber;
    public $orientationNumber;
    public $city;
    public function __construct($avatar, $firstName, $lastName, $title, $company, $available, $phone, $email, $website, $street, $propNumber, $orientationNumber, $city) {
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->title = $title;
        $this->company = $company;
        $this->available = $available;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->street = $street;
        $this->propNumber = $propNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
    }
    public function getAddress() {
        return "$this->street $this->propNumber / $this->orientationNumber, $this->city";
    }
    public function getAvailability() {
        return $this->available ? 'Not available for contracts' : 'Now available for contracts';
    }
}
*/
?>
