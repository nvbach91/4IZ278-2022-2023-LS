<?php require_once './config.php' ?>
<?php require_once './database/Database.php' ?>

<?php

class FeedbacksDB extends Database
{
  public function list($event_id, $limit = null, $offset = null)
  {
    if ($limit !== null && $offset !== null) {
      // Limit the number of feedbacks
      $query = "SELECT * FROM feedbacks WHERE event_id=:event_id LIMIT :limit OFFSET :offset";
      $statement = $this->pdo->prepare($query);
      $statement->bindValue('event_id', $event_id, PDO::PARAM_INT);
      $statement->bindValue('limit', $limit, PDO::PARAM_INT);
      $statement->bindValue('offset', $offset, PDO::PARAM_INT);
    } else {
      // All feedbacks for the event
      $query = "SELECT * FROM feedbacks WHERE event_id=:event_id";
      $statement = $this->pdo->prepare($query);
      $statement->bindValue('event_id', $event_id, PDO::PARAM_INT);
    }

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