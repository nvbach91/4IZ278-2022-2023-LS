<?php require_once 'Database.php';

class ProductDB extends Teadatabase {

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM product");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByID($productId) {
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE product_id = ?");
        $stmt->bindValue(1, $productId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($productData) {
        $sql = "INSERT INTO product (name, description, price, stock, category_id, image_url) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $productData['name'],
            $productData['description'],
            $productData['price'],
            $productData['stock'],
            $productData['category_id'],
            $productData['image_url']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($productId, $productData) {
        $sql = "UPDATE product SET name = ?, description = ?, price = ?, stock = ?, category_id = ?, image_url = ? WHERE product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $productData['name'],
            $productData['description'],
            $productData['price'],
            $productData['stock'],
            $productData['category_id'],
            $productData['image_url'],
            $productId
        ]);
    }

    public function delete($productId) {
        $stmt = $this->pdo->prepare("DELETE FROM product WHERE product_id = ?");
        $stmt->bindValue(1, $productId);
        $stmt->execute();
    }

    public function search($query) {
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE name LIKE ?");
        $stmt->bindValue(1, $query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function decrementStock($productId, $quantity)
{
    $sql = "UPDATE product SET stock = stock - ? WHERE product_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(1, $quantity);
    $stmt->bindValue(2, $productId);
    $stmt->execute();
}

    
}
