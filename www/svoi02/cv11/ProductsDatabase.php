<?php require_once './Database.php'; ?>

<?php

class ProductDatabase extends Database {

    public function fetchAll()
    {
        $query = "SELECT * FROM `cv06_products`";

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public function checkIfProductExists($product_id)
    {
        $query = "SELECT * FROM `cv06_products` WHERE `product_id` = :product_id";

        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'product_id' => $product_id
        ]);

        $result = $statement->fetchAll();

        return !empty($result) ? true : false;
    }

    public function fetchByCategory($category_id)
    {
        $query = "SELECT * FROM `cv06_products` WHERE `category_id` = :category_id";

        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'category_id' => $category_id
        ]);

        return $statement->fetchAll();
    }

    public function fetchById($productIds, $questionMarks)
    {
        $query = "SELECT * FROM `cv06_products` WHERE product_id IN ($questionMarks)";

        $statement = $this->pdo->prepare($query);
        $statement->execute(array_values($productIds));

        return $statement->fetchAll();
    }

    public function getTotalRecords()
    {   
        $query = "SELECT COUNT(*) as `count` FROM `cv06_products`";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
    
        $result = $statement->fetchAll()[0]['count'];
        return $result;
    }

    public function getRecordsCountForCategory($category_id)
    {   
        $query = "SELECT COUNT(*) as `count` FROM `cv06_products` WHERE `category_id` = :category_id";

        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'category_id' => $category_id
        ]);
        $result = $statement->fetchAll()[0]['count'];
        return $result;
    }

    function fetchRecords($itemsCountPerPage, $offset) 
    {
        //edsit this
        $query = "SELECT * FROM `cv06_products` ORDER BY `product_id` ASC LIMIT $itemsCountPerPage OFFSET ?;";
    
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $offset, PDO::PARAM_INT);
    
        $statement->execute();
        
        return $statement->fetchAll();
    }
    
    public function fetchRecordsByCategory($categoryId, $itemsCountPerPage, $offset)
    {
        $query = "SELECT * FROM `cv06_products` WHERE `category_id` = $categoryId ORDER BY `product_id` ASC LIMIT $itemsCountPerPage OFFSET ?;";
    
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $offset, PDO::PARAM_INT);
    
        $statement->execute();
        
        return $statement->fetchAll();
    }

    public function createNewProduct($name, $price, $image, $category_id)
    {
        $query = "INSERT INTO `cv06_products` (`name`, `price`, `img`, `category_id`) VALUES (:name, :price, :image, :category_id)";
    
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            ':name' => $name,
            ':price' => $price,
            ':image' => $image,
            ':category_id' => $category_id
        ]);

        return 200;
    }

    public function deleteProduct($product_id)
    {
        $query = "DELETE FROM `cv06_products` WHERE `product_id` = :product_id;";

        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'product_id' => $product_id
        ]);

        return 200;
    }

    public function editProduct($name, $price, $img, $category_id, $product_id)
    {
        $query = "UPDATE cv06_products SET name = :name, price = :price, img = :img, category_id = :category_id, last_edit = NULL, last_edit_by = NULL WHERE product_id = :product_id;";

        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'name' => $name,
            'price' => $price,
            'img' => $img,
            'category_id' => $category_id,
            'product_id' => $product_id
        ]);

        return 200;
    }

    public function pessimisticEdit($product_id, $user_id)
    {
        $query = "UPDATE cv06_products SET last_edit = now(), last_edit_by = :user_id WHERE product_id = :product_id;";

        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);

        return 200;
    }
}

?>

