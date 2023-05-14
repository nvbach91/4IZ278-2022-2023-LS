<?php

class UserPiece
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserPieces($userId)
    {
        $sql = "SELECT * FROM user_pieces WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function addUserPiece($userId, $pieceId, $quantity)
    {
        $sql = "INSERT INTO user_pieces (user_id, piece_id, quantity)
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId, $pieceId, $quantity]);
    }

    public function updateUserPiece($userId, $pieceId, $quantity)
    {
        $sql = "UPDATE user_pieces SET quantity = ? WHERE user_id = ? AND piece_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$quantity, $userId, $pieceId]);
    }

    public function deleteUserPiece($userId, $pieceId)
    {
        $sql = "DELETE FROM user_pieces WHERE user_id = ? AND piece_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId, $pieceId]);
    }
}
?>