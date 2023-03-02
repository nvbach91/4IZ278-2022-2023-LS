<?php

namespace classes;

use DateTime;
use Exception;

class Person {

    public ?DateTime $birthDate;

    /**
     * @throws Exception
     */
    public function __construct(

        public string                          $logo,
        public string                          $name,
        public string                          $surname,
        private readonly string|\DateTime|null $birth,
        public ?string                         $jobTitle,
        private readonly string                $street,
        private readonly int                   $number,
        private readonly ?int                  $orientationNumber,
        private readonly string                $city,
        private readonly int                   $postNumber,
        public string                          $phone,
        public string                          $mail,
        public string                          $webPade,
        public bool                            $openForWork

    ) {

        $birthDate = $this->birth;
        if (is_string($this->birth)) $birthDate = new DateTime($this->birth);
        $this->birthDate = $birthDate;

    }

    public function getAddress(): string {

        if (!is_null($this->orientationNumber)) {

            return $this->street . ' ' . $this->number . '/' . $this->orientationNumber . ', ' . substr($this->postNumber, 0, 3) . ' ' . substr($this->postNumber, 3, 2) . ' ' . $this->city;

        } else {

            return $this->street . ' ' . $this->number . ', ' . substr($this->postNumber, 0, 3) . ' ' . substr($this->postNumber, 3, 2) . ' ' . $this->city;

        }

    }

    public function getAge(): ?int {

        if(is_null($this->birthDate)) return null;

        $now = new DateTime();
        return date_diff($this->birthDate, $now)->y;

    }

}