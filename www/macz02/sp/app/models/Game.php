<?php

class Game
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createGame($userId, $opponentId)
    {
        $sql = "INSERT INTO games (user_id, opponent_id, start_time) VALUES (?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $opponentId]);
        return $this->db->lastInsertId();
    }

    public function getGame($gameId)
    {
        $sql = "SELECT * FROM games WHERE game_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$gameId]);
        return $stmt->fetch();
    }

    public function recordMove($gameId, $moveNumber, $fromPosition, $toPosition, $capturedPieceId)
    {
        $sql = "INSERT INTO game_moves (game_id, move_number, from_position, to_position, captured_piece_id, timestamp)
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$gameId, $moveNumber, $fromPosition, $toPosition, $capturedPieceId]);
    }

    public function endGame($gameId, $result)
    {
        $sql = "UPDATE games SET end_time = NOW(), result = ? WHERE game_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$result, $gameId]);
    }
}
?>