<?php

class Piece
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getPieces()
    {
        $sql = "SELECT * FROM pieces";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPiece($pieceId)
    {
        $sql = "SELECT * FROM pieces WHERE piece_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$pieceId]);
        return $stmt->fetch();
    }

    public function addPiece($name, $description, $move_rules)
    {
        $sql = "INSERT INTO pieces (name, description, move_rules, created_at, updated_at)
                VALUES (?, ?, ?, NOW(), NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $description, $move_rules]);
    }

    public function updatePiece($pieceId, $name, $description, $move_rules)
    {
        $sql = "UPDATE pieces SET name = ?, description = ?, move_rules = ?, updated_at = NOW() WHERE piece_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $description, $move_rules, $pieceId]);
    }

    public function deletePiece($pieceId)
    {
        $sql = "DELETE FROM pieces WHERE piece_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$pieceId]);
    }
}
?>