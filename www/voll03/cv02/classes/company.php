<?php

class Company
{
    private string $name;
    private string $web;
    private string $street;
    private string $zipcode;
    private string $city;
    private string $country;
    private string $logoImageName;

    public function __construct(
        string $name,
        string $web,
        string $street,
        string $zipcode,
        string $city,
        string $country,
        string $logoImageName
    ) {
        $this->name = $name;
        $this->web = $web;
        $this->street = $street;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->country = $country;
        $this->logoImageName = $logoImageName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWeb(): string
    {
        return $this->web;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getLogoImageName(): string
    {
        return $this->logoImageName;
    }


    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setWeb(string $web)
    {
        $this->web = $web;
    }

    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    public function setLogoImageName(string $logoImageName)
    {
        $this->logoImageName = $logoImageName;
    }
}
