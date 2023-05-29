<?php require_once './config.php' ?>
<?php require_once './database/Database.php' ?>

<?php

class EventsDB extends Resource
{
  protected $tableName = 'events';

  function getUserParticipations($userId)
  {
    $sql = 'SELECT * from events t1 INNER JOIN participations t2 ON t1.event_id = t2.event_id WHERE t2.participant = :user_id';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }
}

?>