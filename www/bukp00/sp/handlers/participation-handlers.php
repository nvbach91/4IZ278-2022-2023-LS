<?php

require_once './database/ParticipationsDB.php';
require_once './database/UsersDB.php';

require_once './handlers/email-handler.php';

require_once './utils.php';

$participationsDB = new ParticipationsDB();
$usersDB = new UsersDB();

function handleAddParticipation($data, $event)
{
  global $participationsDB;
  global $usersDB;
  $formSubmitted = !empty($data);
  $invalidInputs = [];
  $alertMessages = [];

  if ($formSubmitted) {
    $note = htmlspecialchars(trim($data['note']));
    $seats = intval(trim($data['seats']));
    // ToDo: Add timezone
    $createdAt = date('Y-m-d H:i:s');
    $participant = getLoggedUserId();

    if (!($seats && $seats > 0)) {
      array_push($alertMessages, 'You have to participate on at least one seat.');
      array_push($invalidInputs, 'seats');
    }

    /** Check availability */
    $availableSeats = $event['capacity'] - $participationsDB->getParticipantsSum($event['event_id']);

    if ($availableSeats < $seats) {
      array_push($alertMessages, 'Not enought seats available.');
      array_push($invalidInputs, 'seats');
    }

    if (!empty($invalidInputs)) {
      return [
        'invalidInputs' => $invalidInputs,
        'alertMessages' => $alertMessages
      ];
    }

    try {
      $user = $usersDB->getBy('user_id', $participant)[0];

      $participationsDB->create([
        'note' => $note,
        'seats' => $seats,
        'participant' => $participant,
        'event_id' => $event['event_id'],
        'created_at' => $createdAt
      ]);

      sendEmail($user['email'], $event['name'], $event['date'], $note ? $note : 'No note', $seats);

      // Redirect to prevent duplicite calls
      header("Location: " . $_SERVER["REQUEST_URI"]);
      exit;
    } catch (\Throwable $th) {
      var_dump($th);
      return [
        'invalidInputs' => array('unknown'),
        'alertMessages' => array($th->getMessage())
      ];
    }
  }
}
