<?php

require_once './database/FeedbacksDB.php';
require_once './database/ParticipationsDB.php';
require_once './utils.php';

$feedbacksDB = new FeedbacksDB();
$participationsDB = new ParticipationsDB();

function handleAddFeedback($data, $event)
{
  global $feedbacksDB;
  global $participationsDB;
  $formSubmitted = !empty($data);
  $invalidInputs = [];
  $alertMessages = [];

  if ($formSubmitted) {
    $content = htmlspecialchars(trim($data['content']));
    $participant = getLoggedUserId();
    $createdAt = date('Y-m-d H:i:s');

    $participation = $participationsDB->checkUserParticipation($participant, $event['event_id']);

    if (empty($participation)) {
      array_push($alertMessages, 'Only a participant can add a feedback.');
      array_push($invalidInputs, 'participant');
    }

    if (!$content) {
      array_push($alertMessages, 'Feedback content is required.');
      array_push($invalidInputs, 'content');
    }

    if (!empty($invalidInputs)) {
      return [
        'invalidInputs' => $invalidInputs,
        'alertMessages' => $alertMessages
      ];
    }

    try {
      $feedbacksDB->create([
        'event_id' => $event['event_id'],
        'participant' => $participant,
        'created_at' => $createdAt,
        'content' => $content
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
