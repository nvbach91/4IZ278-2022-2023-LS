<?php
//PascalCase ... kazde slovo zacina velkým pismenem
class Person
{

    public function __construct(
        public $firstName,
        public $secondName,
        public $adressName,
        public $adressNumber,
        public $phone,
        public $avatar,
        public $birthYear
    ) {
    }

    function getAge()
    {
        $age = 2023 - $this->birthYear;
        return $age;
    }
    function getFullName()
    {
        $name = $this->firstName . ' ' . $this->secondName;
        return $name;
    }
    function getFullAdress()
    {
        $adress = $this->adressName . ' ' . $this->adressNumber;
        return $adress;
    }
}