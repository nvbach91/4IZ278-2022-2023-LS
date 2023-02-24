<?php
class PersonUtils {
    // Functions
    public function getAdress($postcode, $city, $country, $street, $dn, $rn) {
        return $postcode . ' ' . $city . ', ' . $country . ', ' . $city . ' ' . intdiv($postcode, 10000) . ', ' . $street . ' ' . $dn . '/' . $rn;
    }
    public function generateEmail($name, $lastName) {
        return mb_substr($name, 0, 1) . '.' . $lastName . '@pixelwave.tech';
    }
    public function getAge($dateStr) {
        $now = new DateTime();
        $date = new DateTime($dateStr);
        $age = $now -> diff($date) -> y;
        return $age;
    }
}
?>