<?php

class Person
{
    private $age;
    private $fullName;
    private $phone;
    private $isWorking;
    public function __construct(int $age, string $fullName, string $phone, bool $isWorking)
    {
        $this->age = $age;
        $this->fullName= $fullName;
        $this->phone = $phone;
        $this ->isWorking = $isWorking;
    }
    public function getFullName(){
        return $this ->fullName;
    }
    public function getAge(){
        return $this ->age;
    }
    public function getPhone(){
        return $this -> phone;
    }
    public function getIsWorking(){
        return $this -> isWorking;
    }
    
}
