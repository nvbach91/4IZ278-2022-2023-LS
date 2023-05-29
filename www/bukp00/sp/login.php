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
        <a href="<?php echo htmlspecialchars($loginUrl); ?>" class="">
          <button type="button" class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 mr-2 mb-2">
            <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
              <path fill="currentColor" d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z"></path>
            </svg>
            Sign in with Facebook
          </button>
        </a>
      </div>
      </d>
    </div>
</main>

<?php include './components/footer.php'; ?>