<?php

class Address
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function createAddress($city, $postal_code, $street_plus_number, $country, $userId)
    {
        $stmt = $this->db->prepare("INSERT INTO address (city, postal_code, street_plus_number, country, users_user_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $city, $postal_code, $street_plus_number, $country, $userId);
        $stmt->execute();
        return $this->db->insert_id;
    }
}
?>