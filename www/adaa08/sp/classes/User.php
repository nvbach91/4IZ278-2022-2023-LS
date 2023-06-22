<?php

class User
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getUser($userId)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE user_id = ?');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
        
    }

    public function createUser($firstname, $lastname, $email, $phone, $role, $password)
    {

    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->db->prepare("INSERT INTO users (first_name, second_name, email, phone, role, password) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssss", $firstname, $lastname, $email, $phone, $role, $hashedPassword);
        return $stmt->execute();
    }
    return false;
    }



    public function getUserEmailByOrderId($orderId)
    {
        $stmt = $this->db->prepare('SELECT email FROM users JOIN shop_order ON users.user_id = shop_order.users_user_id WHERE shop_order.order_id = ?');
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user['email'] ?? null;
    }

    public function getAdmins() {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE role = ?');
        $stmt->bind_param('s', $role);
        $role = 'admin'; 
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function getAllUsers() 
{
    $sql = "SELECT email, role FROM users";
    $result = $this->db->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

}