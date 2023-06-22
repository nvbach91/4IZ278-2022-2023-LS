<?php
require_once "Database.php";

class BooksDatabase extends Database {
    private static ?BooksDatabase $sInstance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance(): BooksDatabase {
        if (self::$sInstance === null) self::$sInstance = new BooksDatabase();
        return self::$sInstance;
    }

    public function addBook(string $isbn, string $name, string $author, string $desc, int $category,
                            int    $amount = 1): bool {
        if ($this->getBook($isbn)) return false;

        $query = "INSERT INTO books(isbn, name, author, description, amount, category_id) VALUE (:isbn, :name, :author, :desc, :amount, :catId)";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["isbn" => $isbn, "name" => $name, "author" => $author, "desc" => $desc, "amount" => $amount, "catId" => $category]);
        return true;
    }

    public function getBook(string $isbn): array|false {
        $query = "SELECT * FROM books WHERE isbn = :isbn";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["isbn" => $isbn]);
        return $statement->fetch();
    }

//    public function getBooks(int $category, int $amount = 0, int $offset = 0): array {
    public function getBooks(int $category): array {
        if ($category === 0) return $this->getAllBooks(); // TODO

//        $query = "SELECT * FROM books WHERE category_id = :catId LIMIT :offset, :amount";
        $query = "SELECT * FROM books WHERE category_id = :catId";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("catId", $category, PDO::PARAM_INT);
//        $statement->bindValue("offset", $offset, PDO::PARAM_INT);
//        $statement->bindValue("amount", $amount, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getAllBooks(): array {
        $query = "SELECT * FROM books";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function editBook(string $isbn, string $name, string $author, string $desc, int $category,
                             int    $amount = 1): void {
        $query = "UPDATE books SET isbn = :isbn, name = :name, author = :author, description = :desc, category_id =
            :catId, amount = :amount WHERE isbn = :isbn";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["isbn" => $isbn, "name" => $name, "author" => $author, "desc" => $desc,
            "catId" => $category, "amount" => $amount]);
    }

    public function deleteBook(int $isbn): void {
        $query = "DELETE FROM books WHERE isbn = :isbn";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["isbn" => $isbn]);
    }
}
