<?php
require_once "Database.php";
require_once "ReservationsDatabase.php";
require_once "UserDatabase.php";

// TODO test
class LoansDatabase extends Database {

    public function getLoans(): false|array {
        $query = "SELECT * FROM loans";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUnreturned(): false|array {
        $query = "SELECT * FROM loans WHERE returned = 0";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * get timestamp one month in the future: https://stackoverflow.com/a/6753759/4941406
     */
    public function borrow(int $userId, string $isbn, int $startTimestamp, int $endTimestamp): void {
        $query = "INSERT INTO loans(book_isbn, user_id, start, end) VALUE (:isbn, :userId, :start, :end)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("isbn", $isbn);
        $statement->bindValue("userId", $userId, PDO::PARAM_INT);
        $statement->bindValue("start", date('Y-m-d', $startTimestamp));
        $statement->bindValue("end", date('Y-m-d', $endTimestamp));
        $statement->execute();

        $reservationDb = new ReservationsDatabase();
        $reservationDb->deleteReservation($userId, $isbn);
    }

    public function return(int $userId, string $isbn): int {
        $returnedCheckQuery = "SELECT returned FROM loans WHERE book_isbn = :isbn AND user_id = :userId";
        $statement = $this->pdo->prepare($returnedCheckQuery);
        $statement->execute(["isbn" => $isbn, "userId" => $userId]);

        if ($statement->fetch()["returned"]) return 1;

        $query = "UPDATE loans SET returned = 1 WHERE book_isbn = :isbn AND user_id = :userId";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["isbn" => $isbn, "userId" => $userId]);

        $debtQuery = "SELECT end FROM loans WHERE book_isbn = :isbn AND user_id = :userId";
        $statement = $this->pdo->prepare($debtQuery);
        $statement->execute(["isbn" => $isbn, "userId" => $userId]);

        // checks if the return is in time, if not, adds debt to the users account
        $dateDiff = date_diff(date_create(date('Y-m-d', time())), date_create($statement->fetch()["end"]));
        if ($dateDiff->invert) {
            $usersDb = new UserDatabase();
            $usersDb->addDebt($userId, $dateDiff->days); // TODO edit debt amount
        }

        return 0;
    }

    // TODO possible option to prolong?

    public function deleteLoan(int $userId, string $isbn): void {
        $query = "DELETE FROM loans WHERE user_id = :userId AND book_isbn = :isbn";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["userId" => $userId, "isbn" => $isbn]);
    }

}
