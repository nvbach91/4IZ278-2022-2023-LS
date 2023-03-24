<?php require_once './Database.php'; ?>
<?php

class ProductsDatabase extends Database {
    public function fetchAll() {
        $query = "SELECT * FROM `products`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchByCategory($category_id) {
        $query = "SELECT * FROM `products` WHERE category_id = :category_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'category_id' => $category_id,
        ]);
        return $statement->fetchAll();
    }
}

?>