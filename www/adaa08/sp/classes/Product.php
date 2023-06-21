<?php 

class Product
{
    private $db;
    private $productsPerPage = 9;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getProducts()
    {
    $stmt = $this->db->prepare('SELECT * FROM products WHERE is_deleted = 0');
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function updateQuantity($productId, $quantity) {
        $stmt = $this->db->prepare('UPDATE products SET q_in_stock = q_in_stock + ? WHERE product_id = ?');
        $stmt->bind_param('ii', $quantity, $productId);
        $stmt->execute();
    }   

    public function deleteProduct($productId) {
        $stmt = $this->db->prepare('UPDATE products SET is_deleted = 1 WHERE product_id = ?');
        $stmt->bind_param('i', $productId);
        $stmt->execute();
    }

    public function getProductsPaginated($page) {
        $offset = ($page - 1) * $this->productsPerPage;

        $stmt = $this->db->prepare("SELECT product_id, name, price, description, photo FROM products WHERE is_deleted = 0 LIMIT ? OFFSET ?");
        $stmt->bind_param('ii', $this->productsPerPage, $offset);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalProducts() {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_products FROM products WHERE is_deleted = 0");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['total_products'];
    }

    public function getProductsByCategory($categoryId, $page) {
        $offset = ($page - 1) * $this->productsPerPage;
        $stmt = $this->db->prepare("SELECT product_id, name, price, description, photo FROM products WHERE is_deleted = 0 AND categories_category_id = ? LIMIT ? OFFSET ?");
        $stmt->bind_param('iii', $categoryId, $this->productsPerPage, $offset);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($productId) {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE product_id = ?');
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateProductStock($productId, $quantity)
    {
        $stmt = $this->db->prepare('UPDATE products SET q_in_stock = q_in_stock - ? WHERE product_id = ?');
        $stmt->bind_param('ii', $quantity, $productId);
        $stmt->execute();
    }

    public function updateProduct($productId, $name, $price, $description, $quantity, $categoryId, $photoUrl)
    {
        $stmt = $this->db->prepare('UPDATE products SET name = ?, price = ?, description = ?, q_in_stock = q_in_stock + ?, categories_category_id = ?, photo = ? WHERE product_id = ?');
        $stmt->bind_param('sdsiisi', $name, $price, $description, $quantity, $categoryId, $photoUrl, $productId);
        return $stmt->execute();
    }
    


}

?>
