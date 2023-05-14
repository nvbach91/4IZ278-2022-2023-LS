<?php require_once './config.php' ?>
<?php require_once './database/Database.php' ?>

<?php

class EventsDB extends CrudResource
{
  public function list($limit, $offset)
  {
    $query = "SELECT * FROM events LIMIT :limit OFFSET :offset";
    $statement = $this->pdo->prepare($query);
    $statement->bindValue('limit', $limit, PDO::PARAM_INT);
    $statement->bindValue('offset', $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function get($id)
  {
    $query = "SELECT * FROM events WHERE event_id=:id";
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

  public function fetchByCategory($category)
  {
    $query = "SELECT * from events WHERE category = :category";
    $statement = $this->pdo->prepare($query);
    $statement->execute([
      'category' => $category,
    ]);
    return $statement->fetchAll();
  }

  public function getPages($limit)
  {
    $totalQuery = "SELECT COUNT(*) AS total FROM events";
    $totalStatement = $this->pdo->prepare($totalQuery);
    $totalStatement->execute();
    $total = $totalStatement->fetchAll()[0]['total'];

    return ceil($total / $limit);
  }
}

?>