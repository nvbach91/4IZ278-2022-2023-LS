<?php

function getLoggedUserId()
{
  session_start();
  return $_SESSION['user_id'];
}

function getEventCategoriesArray()
{
  return array('sport', 'theatre', 'public', 'concert', 'others');
}

/** Check if the user is logged on protected page, if not, redirect to login page */
function requireLogin()
{
  session_start();

  if (!isset($_SESSION['access_token'])) {
    header('Location: login.php');
    exit();
  }
}

/** Shows time generated on the server in the user's timezone */
function convertServerTime($datetime)
{
  $time_id = 'datetime_' . uniqid();

?>
  <span id="<?php echo $time_id; ?>"></span>
  <script>
    document.getElementById("<?php echo $time_id; ?>").innerHTML = new Date("<?php echo $datetime . 'Z'; ?>").toLocaleString();
  </script>
<?php }
