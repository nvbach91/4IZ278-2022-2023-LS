<?php
class PersonFunctions
{
    public function createAge(string $dateOfBirth)
    {
        $now = new DateTime();
        $date = new DateTime($dateOfBirth);
        $age = $now->diff($date)->y;
        return $age;
    }
    
    
    public function createFullName(string $name, string $surname)
    {
        return $surname . " " . $name;
    }
    public function createNumber(string $number){
        return "+420" . $number;
    }
    public function createEmail(string $fullName){
        return $fullName . "@redcab.com";
    }
}
