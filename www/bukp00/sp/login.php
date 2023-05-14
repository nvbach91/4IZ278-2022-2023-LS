<?php include './components/header.php'; ?>

<?php

error_reporting(E_ERROR | E_PARSE);

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$fb = new \JanuSoftware\Facebook\Facebook(FB_CONFIG);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginUrl = $helper->getLoginUrl(CONFIG_PROTOCOL . CONFIG_DOMAIN . CONFIG_PATH . '/login-callback.php', $permissions);


?>

<main class="w-full m-auto">
  <div class="flex w-full min-w-0 flex-col break-words rounded-lg border-0 bg-gray-800 px-10 shadow-lg">
    <div class="flex-auto px-4 py-10 text-start lg:px-10">
      <div class="mb-3 text-center">
        <h2 class="text-xl font-bold text-gray-500">
          Login via Facebook
        </h2>
      </div>
      <p class="text-center">
        You will be redirected to Facebook to sign in.
      </p>
      <div class="mt-6 text-center">
        <a href="<?php echo htmlspecialchars($loginUrl); ?>" class="mr-1 mb-1 w-full rounded bg-gray-900 px-6 py-3 text-sm font-bold uppercase text-white shadow outline-none hover:shadow-lg focus:outline-none active:bg-gray-700">
          Přihlásit se
        </a>
      </div>
      </d>
    </div>
</main>

<?php include './components/footer.php'; ?>