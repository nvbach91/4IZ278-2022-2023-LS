<?php

switch ($GLOBALS['path']) {

	case '':
	case '/':
	case 'home':
		require_once __DIR__ . '/../components/homepage/index.php';
		break;

	case 'facebookLogin':
		require_once __DIR__ . '/../components/user/auth/facebookLogin.php';
		break;

	case 'facebookAuthCallback':
		require_once __DIR__ . '/../components/user/auth/facebookAuthCallback.php';
		break;

	case 'login':
		require_once __DIR__ . '/../components/user/auth/login.php';
		break;

	case 'registration':
		require_once __DIR__ . '/../components/user/auth/registration.php';
		break;

	case 'clock':
	case 'clocks':
	case 'worldClock':
	case 'worldClocks':
		require_once __DIR__ . '/../components/worldClocks.php';
		break;

	case 'cart':
	case 'addToCart':
	case 'removeFromCart':
	case 'products':
	case 'editProductOptimistic':
	case 'editProductPessimistic':
	case 'newProduct':
	case 'deleteProduct':
	case 'profile':
	case 'users':
	case 'editRoles':
	case 'logout':
		if (!isLoggedIn()) {
			Header('Location: login?redirect=' . urlencode(base64_encode($GLOBALS['path'] . '?' . $GLOBALS['query'])));
		} else {
			require_once __DIR__ . '/internal.php';
		}
		break;

	default:
		http_response_code(404);
		require __DIR__ . '/../templates/404.php';
		break;

}