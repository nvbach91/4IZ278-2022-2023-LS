<?php require_once './config.php' ?>
<?php require_once './database/Database.php' ?>

<?php

class ParticipationsDB extends Database
{
  public function list($user_id, $limit = null, $offset = null)
  {
    if ($limit !== null && $offset !== null) {
      $query = "SELECT * FROM participations WHERE user_id=:user_id LIMIT :limit OFFSET :offset";
      $statement = $this->pdo->prepare($query);
      $statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
      $statement->bindValue('limit', $limit, PDO::PARAM_INT);
      $statement->bindValue('offset', $offset, PDO::PARAM_INT);
    } else {
      $query = "SELECT * FROM participations WHERE user_id=:user_id";
      $statement = $this->pdo->prepare($query);
      $statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
    }

    $statement->execute();
    return $statement->fetchAll();
  }

  public function create($args)
  {
  }

  public function delete($id)
  {
  }
}

?>