<?php

class Person
{
    private string $name;
    private DateTime $birthDate;
    private string $jobPosition;
    private string $companyName;
    private string $adress;
    private string $phoneNumber;
    private string $email;
    private string $website;
    private bool $lookingForJob;

    public function __construct(
        string $name,
        string $birthDate,
        string $jobPosition,
        string $companyName,
        string $adress,
        string $phoneNumber,
        string $email,
        string $website,
        bool $lookingForJob
    ) {
        $this->name = $name;
        $this->birthDate = DateTime::createFromFormat("d/m/Y",$birthDate);
        $this->jobPosition = $jobPosition;
        $this->companyName = $companyName;
        $this->adress = $adress;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->website = $website;
        $this->lookingForJob = $lookingForJob;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getAge(): int 
    {
        $now = new DateTime(date("d/m/Y"));
        $age = $now->diff($this->birthDate);
        return $age->y;
    }

    public function getJobPosition(): string
    {
        return $this->jobPosition;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getAdress(): string
    {
        return $this->adress;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function isLookingForJob(): bool
    {
        return $this->lookingForJob;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setBirthDate(string $birthDate)
    {
        $this->birthDate = new DateTime($birthDate);
    }

    public function setJobPosition(string $jobPosition)
    {
        $this->jobPosition = $jobPosition;
    }

    public function setCompanyName(string $companyName)
    {
        $this->companyName = $companyName;
    }

    public function setAdress(string $adress)
    {
        $this->adress = $adress;
    }

    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    public function setLookingForJob(bool $lookingForJob)
    {
        $this->lookingForJob = $lookingForJob;
    }
}
