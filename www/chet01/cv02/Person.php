<?php
class Person
{
    public $name;
    public $title;
    public $title2;
    public $unemployed;
    public $adress;
    public $tel;
    public $email;
    public $birthYear;

    public function __construct($name, $title, $title2, $unemployed, $adress, $tel, $email, $birthYear)
    {
        $this->name = $name;
        $this->title = $title;
        $this->title2 = $title2;
        $this->unemployed = $unemployed;
        $this->adress = $adress;
        $this->tel = $tel;
        $this->email = $email;
        $this->birthYear = $birthYear;
    }

    public function getAge()
    {
        return 2023 - $this->birthYear;
    }
}
