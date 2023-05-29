<?php

function eventFormModal($event = null)
{
?>
  <div class="mt-4 flex flex-row justify-between">
    <!-- Only this button is visible by default -->
    <button id="toggleEventFormModal" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
      <svg class="inline-block svg-icon w-5 h-5" viewBox="0 0 20 20">
        <path fill="currentColor" d="M13.68,9.448h-3.128V6.319c0-0.304-0.248-0.551-0.552-0.551S9.448,6.015,9.448,6.319v3.129H6.319
								c-0.304,0-0.551,0.247-0.551,0.551s0.247,0.551,0.551,0.551h3.129v3.129c0,0.305,0.248,0.551,0.552,0.551s0.552-0.246,0.552-0.551
								v-3.129h3.128c0.305,0,0.552-0.247,0.552-0.551S13.984,9.448,13.68,9.448z M10,0.968c-4.987,0-9.031,4.043-9.031,9.031
								c0,4.989,4.044,9.032,9.031,9.032c4.988,0,9.031-4.043,9.031-9.032C19.031,5.012,14.988,0.968,10,0.968z M10,17.902
								c-4.364,0-7.902-3.539-7.902-7.903c0-4.365,3.538-7.902,7.902-7.902S17.902,5.635,17.902,10C17.902,14.363,14.364,17.902,10,17.902
								z">
        </path>
      </svg>
      <?php echo $event == null ? 'Add new event' : 'Edit'; ?>
    </button>
    <div id="eventFormModal" class="fixed inset-x-0 top-0 z-50 grid place-items-center hidden h-full w-full overflow-y-auto overflow-x-hidden bg-gray-800/90">
      <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="pt-8 px-8 relative bg-white rounded-lg shadow dark:bg-gray-700" method="POST" action="">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              <?php echo $event === null ? 'Create new event' : 'Edit event: ' . $event['name']; ?>
            </h3>
          </div>
          <!-- Modal body -->
          <div class="pt-6">
            <?php if ($event !== null) : ?>
              <input type="hidden" name="event_id" value=<?php echo $event['event_id']; ?> />
              <input type="hidden" name="form" value="editEvent" />
            <?php else : ?>

            <?php endif; ?>
            <div class="relative z-0 w-full mb-6 group">
              <input value="<?php echo $event === null ? '' : $event['name']; ?>" type="text" name="name" maxlength="80" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
              <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
              <input value="<?php echo $event === null ? '' : $event['date']; ?>" type="datetime-local" min="<?php echo date('Y-m-d h:m'); ?>" name="date" id="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
              <label for="date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
              <select type="text" name="category" id="category" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:bg-gray-700 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                <option value="" disabled <?php echo $event === null ? ' selected' : ''; ?>>Choose a category</option>
                <option value="sport" <?php echo $event === null && $event['category'] === 'sport' ? ' selected' : ''; ?>>Sport</option>
                <option value="theatre" <?php echo $event === null && $event['category'] === 'theatre' ? ' selected' : ''; ?>>Theatre</option>
                <option value="public" <?php echo $event === null && $event['category'] === 'public' ? ' selected' : ''; ?>>Public</option>
                <option value="concert" <?php echo $event === null && $event['category'] === 'concert' ? ' selected' : ''; ?>>Concert</option>
                <option value="others" <?php echo $event === null && $event['category'] === 'others' ? ' selected' : ''; ?>>Others</option>
              </select>
              <label for="category" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Category</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
              <input value="<?php echo $event === null ? '' : $event['capacity']; ?>" type="number" name="capacity" min="1" id="capacity" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
              <label for="capacity" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Capacity</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
              <textarea rows=4 name="short_description" maxlength="300" id="short_description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required><?php echo $event === null ? '' : $event['short_description']; ?></textarea>
              <label for="short_description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Short description</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
              <textarea value="<?php echo $event === null ? '' : $event['description']; ?>" rows=8 name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required><?php echo $event === null ? '' : $event['description']; ?></textarea>
              <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="flex justify-between p-4 space-x-2">
            <button id="closeEventFormModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
              Cancel
            </button>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
    <script>
      const eventFormModal = document.getElementById("eventFormModal");

      const toggleEventFormModalButton = document.getElementById("toggleEventFormModal");
      const closeEventFormModalButton = document.getElementById("closeEventFormModal");

      toggleEventFormModalButton.onclick = function() {
        eventFormModal.classList.remove("hidden");
        eventFormModal.classList.add("block");
      };

      closeEventFormModalButton.onclick = function() {
        eventFormModal.classList.remove("block");
        eventFormModal.classList.add("hidden");
      }
    </script>
  </div>
<?php } ?>