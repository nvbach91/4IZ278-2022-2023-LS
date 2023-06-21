<?php
require_once "Database.php";

class CategoriesDatabase extends Database {
    private static ?CategoriesDatabase $sInstance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance(): CategoriesDatabase {
        if (self::$sInstance === null) self::$sInstance = new CategoriesDatabase();
        return self::$sInstance;
    }

    public function getCategories(): false|array {
        $query = "SELECT * FROM categories";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getCategory(int $id): string {
        $query = "SELECT name FROM categories WHERE category_id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["id" => $id]);
        return $statement->fetch()["name"];
    }

    public function getCategoryId(string $name): ?int {
        $query = "SELECT category_id FROM categories WHERE name = :name";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["name" => $name]);
        $fetch = $statement->fetch();
        if ($fetch === false) return null;
        else return $fetch["category_id"];
    }

    public function addCategory(string $name): ?int {
        $query = "INSERT INTO categories(name) VALUE (:name)";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["name" => $name]);

        $idQuery = "SELECT category_id FROM categories WHERE name = :name ORDER BY category_id DESC LIMIT 1";
        $statement = $this->pdo->prepare($idQuery);
        $statement->execute(["name" => $name]);

        $fetch = $statement->fetch();
        if ($fetch === false) return null;
        else return $fetch["category_id"];
    }

    public function deleteCategory(int $id): void {
        $query = "DELETE FROM categories WHERE category_id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["id" => $id]);
    }

    public function updateCategory(int $id, string $newName): void {
        $query = "UPDATE categories SET name = :name WHERE category_id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["id" => $id, "name" => $newName]);
    }
}
