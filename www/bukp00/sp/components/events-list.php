<?php
require_once './database/EventsDB.php';
require_once './components/category-filter.php';

$selectedCategory = $_GET['category'];

$eventsDB = new EventsDB();

$limit = 4;
if (isset($_GET['offset'])) {
  $offset = (int)$_GET['offset'];
} else {
  $offset = 0;
}

if ($selectedCategory) {
  $events = $eventsDB->getBy('category', $selectedCategory);
} else {
  $events = $eventsDB->get($limit + $offset);
  $totalPages = $eventsDB->getPages($limit);
}

?>

<div class="flex flex-col items-center justify-center py-2 text-left">
  <div class="flex flex-row gap-4 justify-between w-full rounded-lg rounded-b-none border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
      Seznam nejnovějších událostí
    </h5>
    <?php categoryFilter($offset !== 0 ? [['filterName' => 'offset', 'value' => $offset]] : []); ?>
  </div>
  <div class="grid gap-4 grid-cols-1 lg:grid-cols-2 mt-4">
    <?php foreach ($events as $event) : ?>
      <div class="flex flex-col p-6 h-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
          <?php echo $event["name"]; ?>
        </h5>
        <p class="font-normal text-gray-800 dark:text-gray-200">
          <?php echo $event["date"]; ?>
        </p>
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
  <?php if ($offset / $limit + 1 != $totalPages && !isset($_GET['category'])) : ?>
    <a href="<?php echo './index.php?offset=' . (intval($offset) + intval($limit)); ?>" class="mt-4">
      <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
        Show more
        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </a>
  <?php endif; ?>
</div>