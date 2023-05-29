<?php

require_once './database/EventsDB.php';
require_once './utils.php';

$eventsDB = new EventsDB();

function handleAddEvent($data)
{
  global $eventsDB;
  $formSubmitted = !empty($data);
  $invalidInputs = [];
  $alertMessages = [];

  if ($formSubmitted) {
    $name = htmlspecialchars(trim($data['name']));
    $date = htmlspecialchars(trim($data['date']));
    $category = htmlspecialchars(trim($data['category']));
    $short_description = htmlspecialchars(trim($data['short_description']));
    $description = htmlspecialchars(trim($data['description']));
    $capacity = intval(trim($data['capacity']));
    $organiser = getLoggedUserId();

    // Name validation
    if (!$name) {
      array_push($alertMessages, 'Cannot create an event without a name.');
      array_push($invalidInputs, 'name');
    }

    // Date validation
    $d = DateTime::createFromFormat('Y-m-d\TH:i', $date);
    if (!($d && $d->format('Y-m-d\TH:i') == $date)) {
      array_push($alertMessages, 'Event date is in the wrong format.');
      array_push($invalidInputs, 'date');
    } else {
      // Convert to MySQL format
      $date = $d->format('Y-m-d H:i');
    }

    if (!in_array($category, getEventCategoriesArray())) {
      array_push($alertMessages, 'Event category does not exist.');
      array_push($invalidInputs, 'category');
    }

    if (!($capacity && $capacity > 0)) {
      array_push($alertMessages, 'Event has to have some capacity.');
      array_push($invalidInputs, 'capacity');
    }

    if (!($short_description && strlen($short_description) < 500)) {
      array_push($alertMessages, 'Event short description has to be a string between 1 and 300 chars.');
      array_push($invalidInputs, 'short_description');
    }

    if (!$description) {
      array_push($alertMessages, 'Event description is required.');
      array_push($invalidInputs, 'description');
    }

    if (!empty($invalidInputs)) {
      return [
        'invalidInputs' => $invalidInputs,
        'alertMessages' => $alertMessages
      ];
    }

    try {
      $eventsDB->create([
        'name' => $name,
        'date' => $date,
        'category' => $category,
        'short_description' => $short_description,
        'description' => $description,
        'capacity' => $capacity,
        'organiser' => $organiser
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

function handleEditEvent($data)
{
  global $eventsDB;
  $formSubmitted = !empty($data);
  $invalidInputs = [];
  $alertMessages = [];

  if ($formSubmitted) {
    $event_id = htmlspecialchars(trim($data['event_id']));
    $name = htmlspecialchars(trim($data['name']));
    $date = htmlspecialchars(trim($data['date']));
    $category = htmlspecialchars(trim($data['category']));
    $short_description = htmlspecialchars(trim($data['short_description']));
    $description = htmlspecialchars(trim($data['description']));
    $capacity = intval(trim($data['capacity']));

    if ($event_id === null) {
      return [
        'invalidInputs' => ['event_id'],
        'alertMessages' => ['Event not found.']
      ];
    }

    $currentUserId = getLoggedUserId();
    $event = $eventsDB->getBy('event_id', $event_id)[0];

    /** Invalid event id */
    if ($event === null) {
      return [
        'invalidInputs' => ['event_id'],
        'alertMessages' => ['Event not found.']
      ];
    }

    /** Check the user can edit this event */
    if ($event['organiser'] !== $currentUserId) {
      return [
        'invalidInputs' => ['event_id'],
        'alertMessages' => ['You can only edit your events.']
      ];
    }

    // Name validation
    if (!$name) {
      array_push($alertMessages, 'Cannot create an event without a name.');
      array_push($invalidInputs, 'name');
    }

    // Date validation
    $d = DateTime::createFromFormat('Y-m-d\TH:i', $date);
    if (!($d && $d->format('Y-m-d\TH:i') == $date)) {
      array_push($alertMessages, 'Event date is in the wrong format.');
      array_push($invalidInputs, 'date');
    } else {
      // Convert to MySQL format
      $date = $d->format('Y-m-d H:i');
    }

    if (!in_array($category, getEventCategoriesArray())) {
      array_push($alertMessages, 'Event category does not exist.');
      array_push($invalidInputs, 'category');
    }

    if (!($capacity && $capacity > 0)) {
      array_push($alertMessages, 'Event has to have some capacity.');
      array_push($invalidInputs, 'capacity');
    }

    if (!($short_description && strlen($short_description) < 500)) {
      array_push($alertMessages, 'Event short description has to be a string between 1 and 300 chars.');
      array_push($invalidInputs, 'short_description');
    }

    if (!$description) {
      array_push($alertMessages, 'Event description is required.');
      array_push($invalidInputs, 'description');
    }

    if (!empty($invalidInputs)) {
      return [
        'invalidInputs' => $invalidInputs,
        'alertMessages' => $alertMessages
      ];
    }

    try {
      $eventsDB->updateBy('event_id', $event_id, [
        'name' => $name,
        'date' => $date,
        'category' => $category,
        'short_description' => $short_description,
        'description' => $description,
        'capacity' => $capacity,
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
