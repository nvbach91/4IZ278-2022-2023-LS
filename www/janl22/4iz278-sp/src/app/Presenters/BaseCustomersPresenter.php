<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;

abstract class BaseCustomersPresenter extends BaseAuthPresenter {

	/**
	 * Function to check if the current user is signed in. If so, redirect to intra dashboard. Otherwise, redirect to sign in.
	 *
	 * @return void     Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function startup(): void {

		parent::startup();

	}

}