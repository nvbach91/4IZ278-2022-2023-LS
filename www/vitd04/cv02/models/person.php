<?php
require_once("company.php");
class Person
{
    public function __construct(
        //Avatar nebo Logo
        public string $avatarUrl,
        //Jméno
        private string $firstName,
        //Příjmení
        private string $lastName,
        // Věk (výpočet z datumu narození)
        public DateTimeImmutable $birthDate,
        // Firma
        public Company $company,
        //Povolání nebo Pozice
        public string $role,
        //Telefon
        public string $phone,
        // E-mail
        public string $email,
        // Zda sháníte práci (Boolean)
        public bool $lookingForWork
    )
    {
    }

    public function getAge(): int
    {
        return intval(date('Y', time() - $this->birthDate->getTimestamp())) - 1970;
    }

    public function getFullName(): string
    {
        return $this->firstName . " " . $this->lastName;
    }
}

?>