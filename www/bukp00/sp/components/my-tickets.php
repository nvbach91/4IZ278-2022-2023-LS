<?php require_once './database/EventsDB.php' ?>

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
  //$formErrors = handleAddEvent($_POST);
  // ToDo: Show error message somewhere in case of some errors
}

?>

<div class="flex flex-col items-center justify-center py-2 text-left">
  <div class="flex flex-row justify-between w-full rounded-lg rounded-b-none border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
      Organised events
    </h5>
  </div>
  <ol class="relative border-l border-gray-200 pt-4 dark:border-gray-700">
    <?php foreach ($events as $event) : ?>
      <li class="mb-10 ml-4">
        <div class="absolute -left-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700"></div>
        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
          <?php echo $event["event_id"]; ?>
        </time>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
          <?php echo $event["name"]; ?>
        </h3>
        <p class="text-base font-normal text-gray-500 dark:text-gray-400">
          <?php echo $event["short_description"]; ?>
        </p>
        <a class="flex items-center text-sm font-medium text-sky-500" href="./event.php?event_id=<?php echo $event["event_id"]; ?>">
          <span class="relative">Zobrazit událost</span>
          <svg class="relative mt-px ml-2.5 overflow-visible text-sky-300 dark:text-sky-700" width="3" height="6" viewBox="0 0 3 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M0 0L3 3L0 6"></path>
          </svg>
        </a>
      </li>
    <?php endforeach; ?>
  </ol>
</div>