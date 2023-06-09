<?php

require_once './database/EventsDB.php';
require_once './database/FeedbacksDB.php';
require_once './database/ParticipationsDB.php';

require_once './components/modals/add-feedback-modal.php';
require_once './components/modals/sign-up-modal.php';
require_once './components/modals/event-form-modal.php';

require_once './handlers/participation-handlers.php';
require_once './handlers/feedback-handlers.php';
require_once './handlers/event-handlers.php';

require_once './utils.php';

$loggedUserId = getLoggedUserId();

$eventsDB = new EventsDB();
$feedbacksDB = new FeedbacksDB();
$participationsDB = new ParticipationsDB();

// Get event data and feedbacks
if (isset($_GET['event_id'])) {
  $eventId = $_GET['event_id'];
  $event = $eventsDB->getBy('event_id', $eventId)[0];
  $feedbacks = $feedbacksDB->getBy('event_id', $eventId);

  // Event not found
  if ($event == null) {
    header('Location: index.php');
    exit();
  }
} else {
  header('Location: index.php');
  exit();
}

$owner = $event['organiser'] == $loggedUserId;
$availableSeats = $event['capacity'] - $participationsDB->getParticipantsSum($eventId);
$userSigned = $participationsDB->checkUserParticipation($loggedUserId, $eventId);

if ($owner) {
  $participations = $eventsDB->getEventParticipants($eventId);
}

$canAddFeedback = false;

if ($loggedUserId !== null && !$owner && $userSigned) {
  $canAddFeedback = true;
}

$formSubmitted = !empty($_POST['form']);

if ($formSubmitted) {
  $form = $_POST['form'];
  if ($form == 'signUp') {
    // Handle sign up form
    handleAddParticipation($_POST, $event);
  } else if ($form == 'editEvent') {
    // Handle event edit
    handleEditEvent($_POST);
  } else if ($form == 'addFeedback') {
    // Handle add feedback
    handleAddFeedback($_POST, $event);
  }
}

?>

<div class="flex flex-col items-center justify-center gap-8 py-2 text-left">
  <div class="block rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
      <?php echo $event["name"]; ?>
    </h5>
    <p class="font-normal text-gray-800 dark:text-gray-200">
      <?php echo $event["date"]; ?>
    </p>
    <p class="font-normal text-gray-700 dark:text-gray-400">
      <?php echo $event["short_description"]; ?>
    </p>
    <p class="font-normal">
      <?php echo $event["description"]; ?>
    </p>
    <p class="mt-2 italic">
      Available seats: <?php echo $availableSeats; ?>
    </p>
    <div class="flex flex-column justify-between mt-4">
      <?php $event['organiser'] === $loggedUserId ? eventFormModal($event) : ''; ?>
      <?php $availableSeats > 0 ? signUpModal($availableSeats, $userSigned) : ''; ?>
    </div>
  </div>
  <?php if (!empty($participations)) : ?>
    <div class="block w-full rounded-lg rounded-b-none border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
      <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
        Participations:
      </h5>
    </div>
    <ol class="relative -mt-8 w-full border border-gray-200 pt-2 dark:border-gray-700">
      <?php foreach ($participations as $participation) : ?>
        <li class="mb-10 ml-4 flex flex-wrap gap-1">
          <div class="absolute -left-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"></div>
          <div class="text-sm font-normal text-gray-400 dark:text-gray-500">
            <?php echo $participation["name"]; ?>
          </div>
          <div class="flex flex-col ml-4">
            <p class="mt-auto text-base font-normal text-gray-500 dark:text-gray-300">
              <b>Note: </b><?php echo $participation["note"]; ?>
            </p>
            <p class="text-base font-normal text-gray-500 dark:text-gray-300">
              <b>Reserved seats: </b><?php echo $participation["seats"]; ?>
            </p>
            <p class="mb-3 text-base font-normal text-gray-500 dark:text-gray-300">
              <b>Signed at: </b><?php echo convertServerTime($participation["created_at"]); ?>
            </p>
          </div>
        </li>
      <?php endforeach; ?>
      <?php if ($canAddFeedback) : ?>
        <li class="mb-5 mt-4 flex justify-center">
          <?php addFeedbackModal($event); ?>
        </li>
      <?php endif; ?>
    </ol>
  <?php endif; ?>
  <?php if (!empty($feedbacks) || $canAddFeedback) : ?>
    <div class="block w-full rounded-lg rounded-b-none border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
      <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
        Feedback:
      </h5>
    </div>
    <ol class="relative -mt-8 w-full border border-gray-200 pt-2 dark:border-gray-700">
      <?php foreach ($feedbacks as $feedback) : ?>
        <li class="mb-10 ml-4 flex flex-wrap gap-1">
          <div class="absolute -left-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"></div>
          <div class="text-sm font-normal text-gray-400 dark:text-gray-500">
            <?php echo $feedback["feedback_id"]; ?>
          </div>
          <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
            <?php echo $feedback["participant"]; ?>
          </h3>
          <p class="w-full text-base font-normal text-gray-500 dark:text-gray-400">
            <?php echo $feedback["content"]; ?>
          </p>
        </li>
      <?php endforeach; ?>
      <?php if ($canAddFeedback) : ?>
        <li class="mb-5 mt-4 flex justify-center">
          <?php addFeedbackModal($event); ?>
        </li>
      <?php endif; ?>
    </ol>
  <?php endif; ?>
</div>