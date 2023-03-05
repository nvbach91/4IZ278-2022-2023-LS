<?php
class Person {
    public function __construct(
        public $firstName,
        public $lastName,
        public $position,
        public $avatar,
        public $phone,
        public $city,
        public $address,
        public $street_number,
        public $birthYear,
        public $github,
        public $email,
        public $firm,
        public $work,
        public $githubUser

    ) {}

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }
    public function getAddress()
    {
        return $this->city . ', ' . $this->address . ' ' . $this->street_number;
    }
    public function getAge()
    {
        $currentDateTime = new DateTime();
        $year = $currentDateTime->format('Y');
        return $year - $this->birthYear;
    }
}

?>