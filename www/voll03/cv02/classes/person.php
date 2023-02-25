<?php

class Person
{
    private string $name;
    private string $position;
    private DateTime $birthdate;
    private string $phone;
    private string $email;
    private bool $isEmployed;
    private string $portraitImageName;
    private Company $company;

    public function __construct(
        string $name,
        string $position,
        string $birthdate,
        string $phone,
        string $email,
        bool $isEmployed,
        string $portraitImageName,
        Company $company
    ) {
        $this->name = $name;
        $this->position = $position;
        $this->birthdate = new DateTime($birthdate);
        $this->phone = $phone;
        $this->email = $email;
        $this->isEmployed = $isEmployed;
        $this->portraitImageName = $portraitImageName;
        $this->company = $company ? $company : null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getBirthdate(): string
    {
        return $this->birthdate->format("j.n.Y");
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isEmployed(): bool
    {
        return $this->isEmployed;
    }

    public function getPortraitImageName(): string
    {
        return $this->portraitImageName;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPosition(string $position)
    {
        $this->position = $position;
    }

    public function setBirthdate(string $birthdate)
    {
        $this->birthdate = new DateTime($birthdate);
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setEmployed(bool $employed)
    {
        $this->isEmployed = $employed;
    }

    public function setPortraitImageName(string $portraitImageName)
    {
        $this->portraitImageName = $portraitImageName;
    }

    public function setCompany(?Company $company)
    {
        $this->company = $company;
    }

    public function calculateAge(): int
    {
        $today = new DateTime(date("d.m.Y"));
        return ($today->diff($this->birthdate))->y;
    }
}
