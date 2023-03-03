<?php
class Person {
	public $firstName;
    public $lastName;
    public $department;
	public $position;
	public $phone;
	public $email;
    public $city;
	public $state;
	public $birthYear;

	public function __construct($firstName, $lastName, $department, $position, $phone, $email, $city, $state, $birthYear) {
		$this->firstName = $firstName;
        $this->lastName = $lastName;
		$this->department = $department;
        $this->position = $position;
		$this->phone = $phone;
		$this->email = $email;
		$this->city = $city;
        $this->state = $state;
		$this->birthYear = $birthYear;
	}

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getJob() {
        return $this->department . ' ' . $this->position;
      }

    public function getAdress() {
        return $this->city . ', ' . $this->state;
    }
    
}

?>
