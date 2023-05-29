<?php

require_once './database/ParticipationsDB.php';
require_once './utils.php';

$participationsDB = new ParticipationsDB();

function handleAddParticipation($data, $event)
{
  global $participationsDB;
  $formSubmitted = !empty($data);
  $invalidInputs = [];
  $alertMessages = [];

  if ($formSubmitted) {
    $note = htmlspecialchars(trim($data['note']));
    $seats = intval(trim($data['seats']));
    $createdAt = date('Y-m-d H:i:s');
    $participant = getLoggedUserId();

    // ToDo: Calculate rest capacity


    if (!($seats && $seats > 0)) {
      array_push($alertMessages, 'You have to participate on at least one seat.');
      array_push($invalidInputs, 'seats');
    }

    if (!empty($invalidInputs)) {
      return [
        'invalidInputs' => $invalidInputs,
        'alertMessages' => $alertMessages
      ];
    }

    try {
      $participationsDB->create([
        'note' => $note,
        'seats' => $seats,
        'participant' => $participant,
        'event_id' => $event['event_id'],
        'created_at' => $createdAt
      ]);

      // Redirect to prevent duplicite calls
      header("Location: " . $_SERVER["REQUEST_URI"]);
      exit;
    } catch (\Throwable $th) {
      return [
        'invalidInputs' => array('unknown'),
        'alertMessages' => array($th->getMessage())
      ];
    }
  }
}
