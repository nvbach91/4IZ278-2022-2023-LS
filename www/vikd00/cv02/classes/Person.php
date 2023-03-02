<?php 
class Person
{
    public function __construct(public $firstName, public $lastName, public $logo, public $profession, public $company, public $birthYear)
    {
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
?>