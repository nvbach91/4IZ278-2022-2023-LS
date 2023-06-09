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

  function getEventParticipants($eventId) {
    $sql = 'SELECT * FROM users t1 INNER JOIN participations t2 ON t1.user_id = t2.participant WHERE t2.event_id = :event_id';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':event_id', $eventId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }
}

?>