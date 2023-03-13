<?php
class People {
    public $image;
    public $name;
    public $surname;
    public $birth;
    public $profession;
    public $student;
    public $street;
    public $streetPopis;
    public $streetOrient;
    public $city;
    public $phone;
    public $mail;
    public $webUrl;
    public $doINeedWork;

    /**
     * @param $name
     * @param $surname
     * @param $birth
     * @param $profession
     * @param $student
     * @param $street
     * @param $streetPopis
     * @param $streetOrient
     * @param $city
     * @param $phone
     * @param $mail
     * @param $webUrl
     * @param $doINeedWork
     */
    public function __construct($image, $name, $surname, $birth, $profession, $student, $street, $streetPopis, $streetOrient, $city, $phone, $mail, $webUrl, $doINeedWork)
    {
        $this->image = $image;
        $this->name = $name;
        $this->surname = $surname;
        $this->birth = $birth;
        $this->profession = $profession;
        $this->student = $student;
        $this->street = $street;
        $this->streetPopis = $streetPopis;
        $this->streetOrient = $streetOrient;
        $this->city = $city;
        $this->phone = $phone;
        $this->mail = $mail;
        $this->webUrl = $webUrl;
        $this->doINeedWork = $doINeedWork;
    }


    public function getAge()
    {
        $now = new DateTime();
        $dob = DateTime::createFromFormat('d.m.Y', $this->birth);
        $age = $now->diff($dob)->y;
        return $age;
    }

    public function getFullName() {
        if (strlen($this->surname) > 5) {
            $surname = substr($this->surname, 0, 5);
        } else {
            $surname = $this->surname;
        }
        if (strlen($this->name) > 5) {
            $name = substr($this->name, 0, 5);
        } else {
            $name = $this->name;
        }

        return $name . " " . $surname;
    }

    /**
     * @return mixed
     */
    public function getFullStreet()
    {
        return $this->street." ".$this->streetPopis."/".$this->streetOrient;
    }

}

$newPeople = array(
    new people("https://images.unsplash.com/photo-1481349518771-20055b2a7b24?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzN8fHJhbmRvbS4uLnxlbnwwfHwwfHw%3D&w=1000&q=80","Josef", "Malý", "14.10.2001", "Student", "UK", "Uhrineveska", 58, 8, "Prague", 777777777, "david@gg.gg", "xxx.cz", TRUE),
    new people("https://images.unsplash.com/photo-1575936123452-b67c3203c357?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aW1hZ2V8ZW58MHx8MHx8&w=1000&q=80","Katerina", "Kata", "14.9.2001", "Cyber", "No", "Uhriasdska", 45, 7, "Prague", 777777777, "david@gg.gg", "xxx.cz", FALSE),
    new people("https://cdn.futura-sciences.com/sources/images/dossier/773/01-intro-773.jpg","David", "White", "14.9.2002", "Cyber", "No", "Uhriasdska", 45, 7, "Prague", 777777777, "david@gg.gg", "xxx.cz", TRUE),
    new people("https://www.shutterstock.com/image-photo/mountains-under-mist-morning-amazing-260nw-1725825019.jpg","Vojta", "Zelený", "14.9.2002", "Cyber", "No", "Uhriasdska", 45, 7, "Prague", 777777777, "david@gg.gg", "xxx.cz", TRUE),
    new people("https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8cGVyc29ufGVufDB8fDB8fA%3D%3D&w=1000&q=80","Alena", "Weiss", "14.9.2002", "Random person", "No", "Uhriasdska", 45, 7, "Prague", 777777777, "david@gg.gg", "xxx.cz", TRUE),
    new people("https://www.bentbusinessmarketing.com/wp-content/uploads/2013/02/35844588650_3ebd4096b1_b-1024x683.jpg","Fuzetea", "Isatea", "14.9.2002", "Cyber", "No", "Uhriasdska", 45, 7, "Prague", 777777777, "david@gg.gg", "xxx.cz", TRUE),
    new people("https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/man-person-icon.png","Noits", "notreally", "14.9.2002", "Cyber", "No", "Uhriasdska", 45, 7, "Prague", 777777777, "david@gg.gg", "xxx.cz", TRUE),
    new people("https://www.incimages.com/uploaded_files/image/1920x1080/getty_624206636_200013332000928034_376810.jpg","Jeff", "Bouzow", "14.9.2002", "Cyber", "No", "Uhriasdska", 45, 7, "Prague", 777777777, "david@gg.gg", "xxx.cz", FALSE)
);