<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;

/**
 * Bootstrap
 *
 * Default class containing the boot code.
 */
class Bootstrap {

	/**
	 * Function which initializes the environment, creates a dependency injection (DI) container, and starts the application.
	 *
	 * @return Configurator
	 */
	public static function boot(): Configurator {

		$configurator = new Configurator;
		$appDir = dirname(__DIR__);

		$configurator->enableTracy($appDir . '/log');

		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator->addConfig($appDir . '/config/common.neon');
		$configurator->addConfig($appDir . '/config/services.neon');

		return $configurator;

	}

}
