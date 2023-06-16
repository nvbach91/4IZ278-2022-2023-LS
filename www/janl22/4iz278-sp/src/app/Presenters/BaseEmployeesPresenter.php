<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;

abstract class BaseEmployeesPresenter extends BaseAuthPresenter {

	/**
	 * Function to check if the current user is signed in. If so, redirect to intra dashboard. Otherwise, redirect to sign in.
	 *
	 * @return void     Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function startup(): void {

		parent::startup();

		if (!$this->getUser()->getIdentity()->getData()['employee']) {

			$this->flashmessage('Tato sekce je přístupná pouze zaměstnancům!', 'danger');
			$this->getUser()->logout();
			$this->redirect('Auth:Employee');

		}

	}

}