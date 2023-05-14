<?php
require_once "Database.php";

// TODO test
class ReservationsDatabase extends Database {

    public function getReservations(): false|array {
        $query = "SELECT * FROM reservations";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * get timestamp one month in the future: https://stackoverflow.com/a/6753759/4941406
     */
    public function reserve(int $userId, string $isbn, int $startTimestamp, int $endTimestamp): void {
        $query = "INSERT INTO reservations(book_isbn, user_id, start, end) VALUE (:isbn, :userId, :start, :end)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("isbn", $isbn);
        $statement->bindValue("userId", $userId, PDO::PARAM_INT);
        $statement->bindValue("start", date('Y-m-d', $startTimestamp));
        $statement->bindValue("end", date('Y-m-d', $endTimestamp));
        $statement->execute();
    }

    public function deleteReservation(int $userId, string $isbn): void {
        $query = "DELETE FROM reservations WHERE user_id = :userId AND book_isbn = :isbn";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["userId" => $userId, "isbn" => $isbn]);
    }
}
