<?php

session_start();
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = [];
}

$GLOBALS['request'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$GLOBALS['siteRoot'] = strstr($GLOBALS['request'], '/cv11/', true) . '/cv11/';
$GLOBALS['path'] = substr($GLOBALS['request'], strpos($GLOBALS['request'], '/cv11/') + strlen('/cv11/'));
$GLOBALS['query'] = $_SERVER['QUERY_STRING'];
$GLOBALS['redirect'] = isset($_GET['redirect']) ? base64_decode($_GET['redirect']) : 'home';

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/server.php';
require_once __DIR__ . '/config/facebook.php';
require_once __DIR__ . '/utils/functions.php';

require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/templates/navigation.php';
?>
	<main>
		<div class="container px-4 px-lg-5 mt-4">
			<?php require_once __DIR__ . '/router/main.php'; ?>
		</div>
	</main>
<?php require_once __DIR__ . '/templates/footer.php'; ?>