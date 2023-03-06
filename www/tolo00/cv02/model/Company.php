<?php

class Company
{

    const COMPANY_AVATAR = 'https://esotemp.vse.cz/~tolo00/cv01/avatar.jpg';
    const COMPANY_NAME = 'FaceBlock Ent.';
    const COMPANY_STREET = 'Pražská';
    const COMPANY_STREET_NUMBER = '123/2a';
    const COMPANY_ZIP = '363 01';
    const COMPANY_CITY = 'Ostrov';
    const COMPANY_URL = 'www.faceblockentertainment.com';

    public static function getFullAddress()
    {
        return self::COMPANY_STREET . ' ' . self::COMPANY_STREET_NUMBER . ', ' . self::COMPANY_ZIP . ' ' . self::COMPANY_CITY;
    }

}
