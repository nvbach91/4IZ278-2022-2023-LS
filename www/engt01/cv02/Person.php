<?php

class Person {
    public DateTime $date_of_birth;

    public function __construct(public $firstName, public $lastName, $birthdate, public $phone, public $email,
                                public $web, public $pic, public $available, public $job, public $company,
                                public $street, public $num_d, public $num_o, public $city) {
        $this->date_of_birth = date_create($birthdate);
    }

    public function getAge(): int {
        return date_diff($this->date_of_birth, date_create())->y;
    }

    public function getAddress(): string {
        return $this->street . " " . $this->num_d . "/" . $this->num_o . ", " . $this->city;
    }

    public function getFullname(): string {
        return $this->firstName . " " . $this->lastName;
    }
}
