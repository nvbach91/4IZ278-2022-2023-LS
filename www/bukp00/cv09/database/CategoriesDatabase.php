<?php require_once './config.php' ?>
<?php require_once './database/Database.php' ?>

<?php

class CategoriesDatabase extends Database
{
  public function fetchAll()
  {
    $query = "SELECT * FROM categories";
    $statement = $this->pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
  }
}

?>