<?php
class Person {
    public function __construct(
        public $fName,
        public $lName,
        public $position,
        public $phoneNumber,
        public $city,
        public $address,
        public $streetNumber,
        public $birthYear,
        public $email,
        public $company,
        public $avatar
    ) {}

    public function getFullName() {
        return $this->fName . ' ' . $this->lName;
    }
    public function getAddress()
    {
        return $this->city . ', ' . $this->address . ' ' . $this->streetNumber;
    }
    public function getAge()
    {
        $currentDateTime = new DateTime();
        $year = $currentDateTime->format('Y');
        return $year - $this->birthYear;
    }
}
?>