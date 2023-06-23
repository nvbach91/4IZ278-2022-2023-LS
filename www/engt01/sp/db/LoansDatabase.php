<?php
require_once "Database.php";
require_once "ReservationsDatabase.php";
require_once "UserDatabase.php";

class LoansDatabase extends Database {
    private static ?LoansDatabase $sInstance = null;
    protected int $debtPerDay = 5;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance(): LoansDatabase {
        if (self::$sInstance === null) self::$sInstance = new LoansDatabase();
        return self::$sInstance;
    }

    public function getLoans(): false|array {
        $query = "SELECT * FROM loans";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getLoansForUser(int $userId): false|array {
        $query = "SELECT * FROM loans WHERE user_id = :userId";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["userId" => $userId]);
        return $statement->fetchAll();
    }

    public function getCurrentLoansOfBook(string $isbn): false|array {
        $query = "SELECT * FROM loans WHERE book_isbn = :isbn AND returned = 0";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["isbn" => $isbn]);
        return $statement->fetchAll();
    }

    public function getUnreturnedLoansForUser(int $userId): false|array {
        $query = "SELECT * FROM loans WHERE user_id = :userId AND returned = 0";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["userId" => $userId]);
        return $statement->fetchAll();
    }

    public function getUnreturned(): false|array {
        $query = "SELECT * FROM loans WHERE returned = 0";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function borrow(int $userId, string $isbn, ?int $startTimestamp, int $endTimestamp): void {
        $query = "INSERT INTO loans(book_isbn, user_id, start, end) VALUE (:isbn, :userId, :start, :end)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("isbn", $isbn);
        $statement->bindValue("userId", $userId, PDO::PARAM_INT);
        $statement->bindValue("start", date('Y-m-d', $startTimestamp));
        $statement->bindValue("end", date('Y-m-d', $endTimestamp));
        $statement->execute();

        ReservationsDatabase::getInstance()->deleteReservation($isbn, $userId);
    }

    public function return(int $userId, string $isbn) {
        $returnedCheckQuery = "SELECT * FROM loans WHERE book_isbn = :isbn AND user_id = :userId AND returned = 0";
        $statement = $this->pdo->prepare($returnedCheckQuery);
        $statement->execute(["isbn" => $isbn, "userId" => $userId]);
        $returned = $statement->fetch();
        if (!$returned) return false;

        $query = "UPDATE loans SET returned = 1 WHERE book_isbn = :isbn AND user_id = :userId";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["isbn" => $isbn, "userId" => $userId]);

        $date = DateTime::createFromFormat("Y-m-d", $returned["end"]);
        $now = new DateTime();
        if($date < $now) UserDatabase::getInstance()->addDebt($userId, $now->diff($date)->days * $this->debtPerDay);

        return true;
    }

    public function deleteLoan(int $userId, string $isbn): void {
        $query = "DELETE FROM loans WHERE user_id = :userId AND book_isbn = :isbn";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["userId" => $userId, "isbn" => $isbn]);
    }

}
