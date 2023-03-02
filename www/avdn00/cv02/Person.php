<?php 
class Person{
  

  public function __construct(
  public $firstName,
  public $lastName,
  public $phone,
  public $birthYear,
  public $street,
  public $occupation,
  public $email,
  public $webPage,
  public $available,
  public $logo,
  ) {

  }

  public function GetFullName() {
  $fullName = $this->firstName . ' ' . $this->lastName;
  return $fullName;
}
}
?>