<?php
require_once "Database.php";

class ReservationsDatabase extends Database {
    private static ?ReservationsDatabase $sInstance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance(): ReservationsDatabase {
        if (self::$sInstance === null) self::$sInstance = new ReservationsDatabase();
        return self::$sInstance;
    }

    public function getReservations(): false|array {
        $query = "SELECT * FROM reservations";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getReservationsForUser(int $userId): false|array {
        $query = "SELECT * FROM reservations WHERE user_id = :userId";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("userId", $userId);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getReservationsForBook(string $isbn): false|array {
        $query = "SELECT * FROM reservations WHERE book_isbn = :isbn";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["isbn" => $isbn]);
        return $statement->fetchAll();
    }

    public function reserve(string $isbn, int $userId, ?int $startTimestamp, int $endTimestamp): void {
        $query = "INSERT INTO reservations(book_isbn, user_id, start, end) VALUE (:isbn, :userId, :start, :end)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("isbn", $isbn);
        $statement->bindValue("userId", $userId, PDO::PARAM_INT);
        $statement->bindValue("start", date('Y-m-d', $startTimestamp));
        $statement->bindValue("end", date('Y-m-d', $endTimestamp));
        $statement->execute();
    }

    public function hasReserved(string $isbn, int $userId): bool {
        $query = "SELECT * FROM reservations WHERE book_isbn = :isbn AND user_id = :userId";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("isbn", $isbn);
        $statement->bindValue("userId", $userId, PDO::PARAM_INT);
        $statement->execute();
        if (!$statement->fetch()) return false;
        else return true;
    }

    public function deleteReservation(string $isbn, int $userId): void {
        $query = "DELETE FROM reservations WHERE user_id = :userId AND book_isbn = :isbn";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["userId" => $userId, "isbn" => $isbn]);
    }
}
