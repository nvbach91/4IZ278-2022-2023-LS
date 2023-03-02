<?php
class Person {
        public function __construct(
            public $firstName,
            public $lastName,
            public $job,
            public $imageSrc,
            public $webAdress,
            public $birthYear
        ){}

        public function getAge($currentYear){
            return $currentYear - $this->birthYear;
        }

        public function getFullName() {
            return "$this->firstName $this->lastName (".$this->getAge(2023).")";
        }
    }
?>