<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('/', 'Home:default');
		$router->addRoute('/property', 'Property:list');
		$router->addRoute('/sign-in', 'Login:login');
		$router->addRoute('/sign-up', 'Login:register');
		// $router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');
		return $router;
	}
}
