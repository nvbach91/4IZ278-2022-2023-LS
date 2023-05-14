<?php require_once './config.php' ?>
<?php require_once './database/Database.php' ?>

<?php

class UsersDB extends Database
{
  public function list($limit = null, $offset = null)
  {
    if ($limit !== null && $offset !== null) {
      $query = "SELECT * FROM users LIMIT :limit OFFSET :offset";
      $statement = $this->pdo->prepare($query);
      $statement->bindValue('limit', $limit, PDO::PARAM_INT);
      $statement->bindValue('offset', $offset, PDO::PARAM_INT);
    } else {
      $query = "SELECT * FROM users";
      $statement = $this->pdo->prepare($query);
    }

    $statement->execute();
    return $statement->fetchAll();
  }

  public function get($id)
  {
    $query = "SELECT * FROM users WHERE user_id=:id";
    $statement = $this->pdo->prepare($query);
    $statement->bindValue('id', $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function create($args)
  {
  }

  public function update($args)
  {
  }

  public function delete($id)
  {
  }
}

?>