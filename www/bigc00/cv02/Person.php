<?php 
class Person {
    private string $fullname;
    private int $age;
    private string $address;
    private string $phoneNumber;
    private string $job;
    private string $email;
    private bool $availability;

    public function __construct(
        string $fullname, 
        int $age, 
        string $address,
        string $phoneNumber, 
        string $job, 
        string $email, 
        bool $availability)
    {
        $this -> fullname = $fullname;
        $this -> age = $age;
        $this -> address = $address;
        $this -> phoneNumber = $phoneNumber;
        $this -> job = $job;
        $this -> email = $email;
        $this -> availability = $availability;
    }

    public function getFullName() { return $this -> fullname; }
    public function getAge() { return $this -> age; }
    public function getAddress() { return $this -> address; }
    public function getPhoneNumber() { return $this -> phoneNumber; }
    public function getJob() { return $this -> job; }
    public function getEmail() { return $this -> email; }
    public function getAvailabaility() { return $this -> availability; }
}
?>