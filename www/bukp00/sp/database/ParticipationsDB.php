<?php require_once './config.php' ?>
<?php require_once './database/Database.php' ?>

<?php

class ParticipationsDB extends Resource
{
  protected $tableName = 'participations';

  function getParticipantsSum($eventId) {
    $sql = 'SELECT SUM(seats) AS total FROM participations WHERE event_id = :event_id';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':event_id', $eventId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll()[0]['total'];
  }

  /** Check whether the user is not already signed to the event */
  function checkUserParticipation($userId, $eventId) {
    $sql = 'SELECT * FROM participations WHERE event_id = :event_id AND participant = :participant';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':event_id', $eventId, PDO::PARAM_INT);
    $statement->bindValue(':participant', $userId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }
}

?>