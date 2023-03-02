<?php

class Person
{

    public function __construct(
        public $id,
        public $avatar,
        public $logo,
        public $surname,
        public $name,
        public $position,
        public $company,
        public $email,
        public $website,
        public $seekingjob,
        public $city,
        public $telNumber,
        public $birthDate,
        public $houseNumber,
        public $street,
        public $style
    ) {
    }
    
    

    public function calcAge()
    {
        $bd = explode("/", $this->birthDate);
        return (date("md", date("U", mktime(0, 0, 0, $bd[0], $bd[1], $bd[2]))) > date("md")
        ? ((date("Y") - $bd[2]) - 1)
        : (date("Y") - $bd[2]));
    }

    public function getAddress()
    {
        return $this->street . " " . $this->houseNumber . ", " . $this->city;
    }

    public function getFullName()
    {
        return $this->name . " " . $this->surname;
    }

    public function getAge()
    {
        return $this->calcAge();
    }
}



$goodPerson = new Person(
    "1",
    "https://preview.redd.it/y1iefuo4x1u71.png?width=640&crop=smart&auto=webp&s=030d66ba40d8d851566df053e47491e28cbdf1eb",
    "./logo.png",
    "Tynek",
    "Karel",
    "CEO",
    "Dummy Company",
    "tynk00@vse.cz",
    "Dummycompany.com",
    false,
    "Onett",
    "123456789",
    "11/12/2000",
    99,
    "Random Street",
    "https://i.pinimg.com/originals/56/09/e7/5609e73532034871db58458c29751945.png"
);

$badPerson = new Person(
    "2",
    "https://i1.sndcdn.com/artworks-TizmqzrwaPobfCip-P9s1ZA-t500x500.jpg",
    "https://a.thumbs.redditmedia.com/21NhnPBOXidoMZS9frgagWWpIyy1wo7DRDgXx4xIh-4.jpg",
    "osoba",
    "Druhá",
    "CEO",
    "Bad Company",
    "no@mail.com",
    "badcompany.com",
    false,
    "Onett",
    "987654321",
    "1/1/2009",
    99,
    "Bad Street",
    "https://wallpaperaccess.com/full/1961455.jpg"
);

$thirdPerson = new Person(
    "3",
    "https://www.clipartmax.com/png/middle/452-4521723_lucas-gba-remastered-lucas-mother-3.png",
    "data:image/jpeg;base64,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",
    "osoba",
    "Třetí",
    "CEO",
    "Good Company",
    "goodo@gd.com",
    "Goodcompany.com",
    false,
    "
    Tazmily Village",
    "111116789",
    "9/1/2005",
    99,
    "Good Street",
    "https://w0.peakpx.com/wallpaper/67/486/HD-wallpaper-polygonal-triangles-shades-yellow-background-yellow.jpg"
);


$people = [$goodPerson, $badPerson, $thirdPerson];

?>