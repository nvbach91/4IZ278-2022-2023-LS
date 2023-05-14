<?php

class GameMove
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function recordMove($gameId, $moveNumber, $fromPosition, $toPosition, $capturedPieceId)
    {
        $sql = "INSERT INTO game_moves (game_id, move_number, from_position, to_position, captured_piece_id, timestamp)
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$gameId, $moveNumber, $fromPosition, $toPosition, $capturedPieceId]);
    }

    public function getMoves($gameId)
    {
        $sql = "SELECT * FROM game_moves WHERE game_id = ? ORDER BY move_number";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$gameId]);
        return $stmt->fetchAll();
    }
}
?>