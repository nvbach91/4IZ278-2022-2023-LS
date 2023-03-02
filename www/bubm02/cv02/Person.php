<?php
class Person {
    public function __construct(
        public $name,
        public $surname,
        public $position,
        public $firmName,
        public $street,
        public $streetNumber1,
        public $streetNumber2,
        public $city,
        public $phone,
        public $email,
        public $web,
        public $lookingForJob,
        public $birthYear,
        public $avatar
    ){}

    public function getAge()
    {
        $currentYear = date("Y");
        return $currentYear - $this->birthYear;
    }

    public function getLookingForJob()
    {
        if ($this->lookingForJob) {
            return "Available for contracts";
        } else {
            return "Not available for contracts";
        }
    }
}
?>