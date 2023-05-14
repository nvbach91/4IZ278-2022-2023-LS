<?php
require_once "Database.php";

// TODO test
class CategoriesDatabase extends Database {

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
        return $statement->fetch()["email"];
    }

    public function addCategory(string $name): int {
        $query = "INSERT INTO categories(name) VALUE (:name)";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["name" => $name]);

        $idQuery = "SELECT category_id FROM categories WHERE name = :name ORDER BY category_id DESC LIMIT 1";
        $statement = $this->pdo->prepare($idQuery);
        $statement->execute(["name" => $name]);

        return $statement->fetch()["category_id"];
    }

    public function deleteCategory(int $id): void {
        $query = "DELETE FROM categories WHERE category_id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["id" => $id]);
    }

    public function updateCategory(int $id, string $name): void {
        $query = "UPDATE categories SET name = :name WHERE category_id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["id" => $id, "name" => $name]);
    }
}
