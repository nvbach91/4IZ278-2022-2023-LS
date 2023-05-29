<?php

require_once './utils.php';

function addFeedbackModal($event)
{
  requireLogin();
?>
  <div>
    <!-- Only this button is visible by default -->
    <button id="toggleModal" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
      Přidat zpětnou vazbu
    </button>
    <div id="addFeedbackModal" class="fixed inset-x-0 top-0 z-50 grid place-items-center hidden h-full w-full overflow-y-auto overflow-x-hidden bg-gray-800/90">
      <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="p-8 relative bg-white rounded-lg shadow dark:bg-gray-700" method="POST" action="">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              <?php echo $event['name']; ?>
            </h3>
          </div>
          <!-- Modal body -->
          <div class="p-4 w-full">
            <label class="mb-1 block text-xs font-bold capitalize text-gray-600">
              Feedback
            </label>
            <textarea name="content" type="text" class="w-full rounded border-0 bg-white p-3 text-sm text-gray-700 shadow placeholder:text-gray-400 focus:outline-none focus:ring"></textarea>
          </div>
          <input type="hidden" name="form" value="addFeedback">
          <!-- Modal footer -->
          <div class="flex justify-between p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button id="closeModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
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
      const modal = document.getElementById("addFeedbackModal");

      const toggleButton = document.getElementById("toggleModal");
      const closeButton = document.getElementById("closeModal");

      toggleButton.onclick = function() {
        modal.classList.remove("hidden");
        modal.classList.add("block");
      };

      closeButton.onclick = function() {
        modal.classList.remove("block");
        modal.classList.add("hidden");
      }
    </script>
  </div>
<?php } ?>