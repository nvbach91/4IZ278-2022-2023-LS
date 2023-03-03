<?php
function calculateAge($person){
    $dateField=explode('/',$person->dateOfBirth);
    $number=(int)$dateField*10000;
    return ((int)$dateField[1]*100+(int)$dateField[0]>date('md')?(date('Y')-(int)$dateField[2]-1):(date('Y')-(int)$dateField[2]));
};

function getFullName($person){
    return $person->firstName.' '.$person->lastName;
}

function getFullAddress($person){
    return $person->streetName.' '.$person->buildingNumber.'/'.$person->orientationNumber.', '.$person->city;
}
?>