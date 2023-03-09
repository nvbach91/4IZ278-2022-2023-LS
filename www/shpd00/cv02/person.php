<?php
include 'utils.php';

class Person{
    public $avatar;
    public $firstName;
    public $lastName;
    public $title;
    public $company;
    public $phone;
    public $email;
    public $website;
    public $available;
    public $street;
    public $propertyNumber;
    public $orientationNumber;
    public $city;
    public $bankBalance;
    public $currency;
    public $birthYear;

    public function __construct($avatar,$firstName,$lastName,$title,$company,$phone,$email,$website,$available,$street,$propertyNumber,$orientationNumber,$city,$birthYear){
        $this->avatar =$avatar;
        $this->firstName =$firstName;
        $this->lastName =$lastName;
        $this->title =$title;
        $this->company =$company;
        $this->phone =$phone;
        $this->email =$email;
        $this->website =$website;
        $this->available =$available;
        $this->street =$street;
        $this->propertyNumber =$propertyNumber;
        $this->orientationNumber =$orientationNumber;
        $this->city =$city;
        $this->birthYear = $birthYear;
    }
    public function getAdress(){
        return $this->street . ' ' . $this->propertyNumber . '/' . $this->orientationNumber . ', ' . $this->city;
    }
    public function getFullName(){
        return $this->firstName . ' ' . $this->lastName;
    }
    public function getAge(){
        return countAge($this->birthYear);
    }
}
?>