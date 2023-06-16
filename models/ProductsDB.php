<?php require_once 'db.php' ?>
<?php

class ProductsDatabase extends DB
{

    public function fetchAll()
    {
        $query = "SELECT * FROM `sp_products`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchByCategory($category_id)
    {
        $query = "SELECT * FROM `sp_products` WHERE category_id = :category_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'category_id' => $category_id,
        ]);
        return $statement->fetchAll();
    }

    public function fetchById($productId)
    {
        $query = "SELECT * FROM `sp_products` WHERE `product_id` = :productId";
        $statement = $this->pdo->prepare($query);
        $statement->execute(['productId' => $productId]);
        return $statement->fetch();
    }

    public function fetchAllPagination($limit, $offset)
    {
        $query = "SELECT * FROM sp_products  ORDER BY product_id LIMIT $limit OFFSET ?;";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getCount()
    {
        $query = "SELECT COUNT(*) AS count FROM sp_products";
        $count = $this->pdo->prepare($query);
        $count->execute();
        return $count->fetchAll()[0]['count'];
    }

    public function getCountByCategoryId($category_id)
    {
        $query = "SELECT COUNT(*) AS count FROM sp_products WHERE category_id = :category_id";
        $count = $this->pdo->prepare($query);
        $count->execute([
            'category_id' => $category_id
        ]);
        return $count->fetchAll()[0]['count'];
    }

    public function fetchByIdNameOrder($question_marks, $ids)
    {
        $query = "SELECT * FROM sp_products WHERE product_id IN ($question_marks) ORDER BY name";
        $statement = $this->pdo->prepare($query);
        $statement->execute(array_values($ids));
        return $statement->fetchAll();
    }

    public function getSum($question_marks, $ids)
    {
        $query = "SELECT SUM(price) FROM sp_products WHERE product_id IN ($question_marks)";
        $statement_sum = $this->pdo->prepare($query);
        $statement_sum->execute(array_values($ids));
        return $statement_sum->fetchColumn();
    }

    public function createProduct($name, $price, $description, $img, $available, $category_id)
    {
        $query = "INSERT INTO `sp_products` (name, price, description, img, available, category_id) VALUES (:name, :price, :description, :img, :available, :category_id)";
        $statement = $this->pdo->prepare($query);
        $statement->execute(['name' => $name, 'price' => $price, 'description' => $description, 'img' => $img, 'available' => $available, 'category_id' => $category_id]);
    }

    public function updateProduct($product_id, $name, $price, $description, $img, $available)
    {
        $query = "UPDATE `sp_products`  SET name = :name, price = :price, description = :description, img = :img, available = :available WHERE product_id = :product_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(['product_id' => $product_id, 'name' => $name, 'price' => $price, 'description' => $description, 'img' => $img, 'available' => $available]);
    }

    public function deleteProduct($product_id)
    {
        $query = "DELETE FROM `sp_products` WHERE `product_id` = :product_id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(['product_id' => $product_id]);
    }
}

?>