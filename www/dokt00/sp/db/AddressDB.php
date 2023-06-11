<?php 
require_once 'Database.php';

class AddressDB extends Teadatabase {

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM address");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByID($addressId) {
        $stmt = $this->pdo->prepare("SELECT * FROM address WHERE address_id = ?");
        $stmt->bindValue(1, $addressId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($addressData) {
        $sql = "INSERT INTO address (user_id, street, city, psc) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $addressData['user_id'],
            $addressData['street'],
            $addressData['city'],
            $addressData['psc']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($addressId, $addressData) {
        $sql = "UPDATE address SET user_id = ?, street = ?, city = ?, psc = ? WHERE address_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $addressData['user_id'],
            $addressData['street'],
            $addressData['city'],
            $addressData['psc'],
            $addressId
        ]);
    }

    public function delete($addressId) {
        $stmt = $this->pdo->prepare("DELETE FROM address WHERE address_id = ?");
        $stmt->bindValue(1, $addressId);
        $stmt->execute();
    }
}
