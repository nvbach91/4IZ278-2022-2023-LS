<?php

    // class Person {
    //     public $name;
    //     public $surname;
    //     public $phone;
    //     public $birthYear;
    //     public $city;

    //     public function __construct($name, $surname, $phone, $birthYear, $city) {
    //         $this -> name = $name;
    //         $this -> surname = $surname;
    //         $this -> phone = $phone;
    //         $this -> birthYear = $birthYear;
    //         $this -> city = $city;
    //     }
    // }

    class Person {
        public function __construct(        
            public $name,
            public $surname,
            public $phone,
            public $birthYear,
            public $city,
            public $pic
        ) {
            
        }

        function getFullName () {
            return $this->name . " " . $this->surname;
        }

        function calcAge(){
            return 2023 - $this->birthYear;
        }
    }
?>