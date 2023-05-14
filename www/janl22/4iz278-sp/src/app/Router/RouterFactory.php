<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;

/**
 * Router factory
 *
 * Default class for pages router.
 */
final class RouterFactory {

	use Nette\StaticClass;

    /**
     * Default function to create site router.
     *
     * @return RouteList
     */
	public static function createRouter(): RouteList {

		$router = new RouteList;
		$router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');
		return $router;

	}

}
