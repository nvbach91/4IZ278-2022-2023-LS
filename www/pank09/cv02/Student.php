<?php

class Student {
    public function __construct(
        public $firstName,
        public $lastName,
        public $phone,
        public DateTime $bday,
        public $pohlavi,
        public $address,
        public $logo = "https://pr.vse.cz/wp-content/uploads/page/58/VSE_logo_CZ_horizontal_black.png"
    ) {

    }

    public function getFullName() : string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getAge() : int {
        return $this->bday->diff(new DateTime("now"))->y;
    }

    public function getStatus() {
        return "VŠE student". ($this->pohlavi === "žena" ? "ka" : "") .", " . $this->getAge() ." let";
    }
}