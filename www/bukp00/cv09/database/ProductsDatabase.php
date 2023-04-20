<?php require_once './config.php' ?>
<?php require_once './database/Database.php' ?>

<?php

class ProductsDatabase extends Database
{
  public function fetchAll($limit, $offset)
  {
    $query = "SELECT * FROM products LIMIT :limit OFFSET :offset";
    $statement = $this->pdo->prepare($query);
    $statement->bindValue('limit', $limit, PDO::PARAM_INT);
    $statement->bindValue('offset', $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchByCategory($category_id) {
    $query = "SELECT * from products WHERE category_id = :category_id";
    $statement = $this->pdo->prepare($query);
    $statement->execute([
      'category_id' => $category_id,
    ]);
    return $statement->fetchAll();
  }

  public function getProductsPages($limit)
  {
    $totalQuery = "SELECT COUNT(*) AS total FROM products";
    $totalStatement = $this->pdo->prepare($totalQuery);
    $totalStatement->execute();
    $total = $totalStatement->fetchAll()[0]['total'];

    return ceil($total / $limit);
  }
}

?>