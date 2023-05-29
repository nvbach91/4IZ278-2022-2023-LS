<?php include './components/header.php'; ?>

<?php
session_start();

if (!isset($_SESSION['access_token'])) {
  header('Location: index.php');
  exit();
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/database/EventsDB.php';
require_once __DIR__ . '/database/UsersDB.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils.php';

$accessToken = $_SESSION['access_token'];

$fb = new \JanuSoftware\Facebook\Facebook(array_merge(FB_CONFIG, ['default_access_token' => $accessToken]));
$eventsDB = new EventsDB();
$usersDB = new UsersDB();

try {
  $me = $fb->get('/me')->getGraphNode();
  $picture = $fb->get('/me/picture?redirect=false&height=200')->getGraphNode();
} catch (Exception $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (Exception $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$helper = $fb->getRedirectLoginHelper();

$logoutUrl = $helper->getLogoutUrl($accessToken, './index.php');

$organisedEvents = $eventsDB->getBy('organiser', getLoggedUserId(), $limit, $offset);
$dbUser = $usersDB->getBy('user_id', getLoggedUserId());

/** Handle form submission */
$formSubmitted = !empty($_POST['email']);

if ($formSubmitted) {
  $email = $_POST['email'];
  // Update email
  $usersDB->updateBy('user_id', $dbUser[0]['user_id'], ['email' => $email]);
  // To prevent duplicate submit
  header("Location: " . $_SERVER["REQUEST_URI"]);
  exit;
}

?>

<main class="flex font-medium items-center justify-center h-full">
  <form class="w-64 mx-auto bg-gray-800 rounded-2xl px-8 py-6 shadow-lg" method="POST" action="">
    <div class="flex items-center justify-between">
      <span class="text-gray-400 text-sm">Organised: <?php echo count($organisedEvents); ?> Events</span>
    </div>
    <div class="mt-6 w-fit mx-auto">
      <img src="<?php echo $picture->getField('url'); ?>" class="rounded-full w-28 " alt="profile picture">
    </div>

    <div class="mt-8 ">
      <h2 class="text-white font-bold text-2xl tracking-wide"><?php echo $me->getField('name'); ?></h2>
    </div>
    <div class="mb-8 ">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-400">Edit e-mail:</label>
      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $dbUser[0]['email']; ?>">
    </div>

    <p class="text-emerald-400 font-semibold mt-2.5">
      Active
    </p>

    <div class="flex items-center justify-between">
      <span class="text-gray-400 text-sm">Visited: <?php echo count($organisedEvents); ?> Events</span>
    </div>

    <div class="pt-6 flex justify-center w-full">
      <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Save email
      </button>
    </div>

  </form>
</main>

<?php include './components/footer.php'; ?>