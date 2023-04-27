<?php

switch ($GLOBALS['path']) {

	case
	'cart':
		require_once __DIR__ . '/../components/cart/index.php';
		break;

	case 'addToCart':
		require_once __DIR__ . '/../components/cart/add.php';
		break;

	case 'removeFromCart':
		require_once __DIR__ . '/../components/cart/remove.php';
		break;

	case 'products':
		require_once __DIR__ . '/../components/product/index.php';
		break;

	case 'editProduct':
		require_once __DIR__ . '/../components/product/edit.php';
		break;

	case 'deleteProduct':
		require_once __DIR__ . '/../components/product/delete.php';
		break;

	case 'profile':
		require_once __DIR__ . '/../components/user/profile.php';
		break;

	case 'users':
		require_once __DIR__ . '/../components/user/userList.php';
		break;

	case 'editRoles':
		require_once __DIR__ . '/../components/user/roles/index.php';
		break;

	case 'logout':
		require_once __DIR__ . '/../components/user/logout.php';
		break;

	default:
		http_response_code(404);
		require __DIR__ . '/../templates/404.php';
		break;

}