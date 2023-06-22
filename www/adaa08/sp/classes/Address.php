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

    public function getUserAddresses($userId)
    {
        $stmt = $this->db->prepare('SELECT * FROM address WHERE users_user_id = ?');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAddress($id) {
        $stmt = $this->db->prepare("SELECT * FROM address WHERE address_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>