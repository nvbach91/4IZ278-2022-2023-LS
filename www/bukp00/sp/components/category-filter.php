<?php
function categoryFilter()
{
  $selectedCategory = $_GET['category'];

  if ($selectedCategory === null) {
    $selectedCategory = 'default';
  }
?>
  <form class="flex flex-column gap-2" method="GET" action="./index.php">
    <select type="text" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
      <option value="" disabled <?php echo $selectedCategory === 'default' ? ' selected' : ''; ?>>Filter by category</option>
      <option value="sport" <?php echo $selectedCategory === 'sport' ? ' selected' : ''; ?>>Sport</option>
      <option value="theatre" <?php echo $selectedCategory === 'theatre' ? ' selected' : ''; ?>>Theatre</option>
      <option value="public" <?php echo $selectedCategory === 'public' ? ' selected' : ''; ?>>Public</option>
      <option value="concert" <?php echo $selectedCategory === 'concert' ? ' selected' : ''; ?>>Concert</option>
      <option value="others" <?php echo $selectedCategory === 'others' ? ' selected' : ''; ?>>Others</option>
    </select>
    <button class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800" type="submit">
      Filter
    </button>
  </form>
<?php } ?>