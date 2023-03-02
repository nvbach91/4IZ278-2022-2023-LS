<?php
class Company
{
    public function __construct(
        // Název firmy
        public string $name,
        // Ulice
        private string $street,
        // Číslo popisné
        private string $houseNumber,
        // Číslo orientační
        public string $zip,
        //Město
        public string $city,

        // Adresa webové stránky
        public string $web,

    )
    {
    }

    public function getAddress(): string
    {
        return $this->street . " " . $this->houseNumber;
    }
}

?>