<?php
class Person {

    // FIELDS
    private $name;
    private $lastname;
    private $age;
    private $phone;
    private $position;
    private $email;
    private $available;

    // CONSTRUCTOR
    public function __construct(string $name, string $lastname, int $age, 
        string $phone, string $position, string $email, bool $available) {
            $this -> name = $name;
            $this -> lastname = $lastname;
            $this -> age = $age;
            $this -> phone = $phone;
            $this -> position = $position;
            $this -> email = $email;
            $this -> available = $available;        
    }

    // GETTERS
    public function getName() { return $this -> name; }
    public function getLastName() { return $this -> lastname; }
    public function getAge() { return $this -> age; }
    public function getPhone() { return $this -> phone; }
    public function getPosition() { return $this -> position; }
    public function getEmail() { return $this -> email; }
    public function getAvailable() { return $this -> available; }
}
?>