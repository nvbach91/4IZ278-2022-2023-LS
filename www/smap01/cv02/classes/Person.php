<?php
class Person
{
    //Constructor promotion
    public function __construct(
        public $firstName,
        public $lastName,
        public $dateOfBirth,
        public $position,
        public $company,
        public $streetName,
        public $buildingNumber,
        public $orientationNumber,
        public $city,
        public $telephone,
        public $email,
        public $avatar,
        public $webpage,
        public $isJobless
    ){}

function getFullName($person){
    return $person->firstName.' '.$person->lastName;
}

function getFullAddress($person){
    return $person->streetName.' '.$person->buildingNumber.'/'.$person->orientationNumber.', '.$person->city;
}
}
?>