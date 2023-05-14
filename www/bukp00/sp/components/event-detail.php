<?php require_once './database/EventsDB.php' ?>
<?php require_once './database/FeedbacksDB.php' ?>
<?php

$eventsDB = new EventsDB();
$feedbacksDB = new FeedbacksDB();

if (isset($_GET['event_id'])) {
  $event_id = $_GET['event_id'];
  $event = $eventsDB->get($event_id)[0];
  $feedbacks = $feedbacksDB->list($event_id);
} else {
  header('Location: index.php');
  exit();
}

?>
<div class="flex flex-col items-center justify-center gap-8 py-2 text-left">
  <div class="block rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
      <?php echo $event["name"]; ?>
    </h5>
    <p class="font-normal text-gray-700 dark:text-gray-400">
      <?php echo $event["short_description"]; ?>
    </p>
    <p class="font-normal">
      <?php echo $event["description"]; ?>
    </p>
  </div>
  <div class="block w-full rounded-lg rounded-b-none border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
      Zpětná vazba:
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
  </ol>
</div>