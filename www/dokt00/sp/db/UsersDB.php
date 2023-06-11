<?php require_once 'Database.php';

class UsersDB extends Teadatabase {
    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bindValue(1, $userId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($userData) {
        $sql = "INSERT INTO users (username, email, password, first_name, last_name, phone) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $userData['username'],
            $userData['email'],
            $userData['password'],
            $userData['first_name'],
            $userData['last_name'],
            $userData['phone']
        ]);
        return $this->pdo->lastInsertId();
    }
    

    public function update($userId, $userData) {
        $sql = "UPDATE users SET email = ?, password = ?, first_name = ?, last_name = ?, username = ?, isAdmin = ?, phone = ? WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $userData['email'],
            $userData['password'],
            $userData['first_name'],
            $userData['last_name'],
            $userData['username'],
            $userData['isAdmin'],
            $userData['phone'],
            $userId
        ]);
    }

    public function delete($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bindValue(1, $userId);
        $stmt->execute();
    }

    public function deleteAll() {
        $stmt = $this->pdo->prepare("DELETE FROM users");
        $stmt->execute();
    }

    public function getByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindValue(1, $username);
        $stmt->execute();
        return $stmt->fetch();
    }
}
