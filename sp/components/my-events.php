<?php require_once './database/EventsDB.php' ?>
<?php require_once './components/modals/event-form-modal.php' ?>
<?php require_once './handlers/event-handlers.php' ?>

<?php

session_start();

if (!isset($_SESSION['access_token'])) {
  header('Location: index.php');
  exit();
}

$eventsDB = new EventsDB();

$limit =  10;
if (isset($_GET['offset'])) {
  $offset = intval($_GET['offset']);
} else {
  $offset = 0;
}

$events = $eventsDB->getBy('organiser', $_SESSION['user_id'], $limit, $offset);
$totalPages = $eventsDB->getPages($limit);

/** Handle form submission */
$formSubmitted = !empty($_POST);

if ($formSubmitted) {
  $formErrors = handleAddEvent($_POST);
  var_dump($formErrors);
  // ToDo: Show error message somewhere in case of some errors
}

?>

<div class="flex flex-col items-center justify-center py-2 text-left">
  <div class="flex flex-row justify-between w-full rounded-lg rounded-b-none border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
      Organised events
    </h5>
    <?php eventFormModal(); ?>
  </div>
  <div class="grid gap-4 grid-cols-1 lg:grid-cols-2 mt-4">
    <?php foreach ($events as $event) : ?>
      <div class="flex flex-col p-6 h-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
          <?php echo $event["name"]; ?>
        </h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
          <?php echo $event["short_description"]; ?>
        </p>
        <a href="./event.php?event_id=<?php echo $event["event_id"]; ?>" class="mt-auto w-fit inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Show event
          <svg class="relative mt-px ml-2.5 overflow-visible text-white" width="3" height="6" viewBox="0 0 3 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M0 0L3 3L0 6"></path>
          </svg>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>