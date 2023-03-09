<?php
class Person {
    public function __construct(
        public $avatar,
        public $surname,
        public $firstname,
        public $birthdate,
        public $position,
        public $company,
        public $street,
        public $housenumber,
        public $orientationnumber,
        public $city,
        public $phone,
        public $email,
        public $website,
        public $looking_for_job  
    ){}

    public function getAddress()
    {
        return $this->street . ' ' . $this->housenumber . '/' . $this->orientationnumber . ', ' . $this->city;
    }

    public function getFullName()
    {
        return $this->surname . ' ' . $this->firstname;
    }

    public function getAge()
    {
        $birthDate = new DateTime($this->birthdate);
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;
        return $age;
    }
}
?>