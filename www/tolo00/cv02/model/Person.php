<?php

class Person
{

    public string $name;

    public string $surname;

    public DateTime $dateOfBirth;

    public string $proffesion;

    public string $phone;

    public string $email;

    public bool $lookingForJob;

    public function __construct(
        $name,
        $surname,
        $dateOfBirth,
        $proffesion,
        $phone,
        $email,
        $lookingForJob
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->dateOfBirth = new DateTime($dateOfBirth);
        $this->proffesion = $proffesion;
        $this->phone = $phone;
        $this->email = $email;
        $this->lookingForJob = $lookingForJob;
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getAge()
    {
        return $this->dateOfBirth->diff(new DateTime)->y;
    }

}
