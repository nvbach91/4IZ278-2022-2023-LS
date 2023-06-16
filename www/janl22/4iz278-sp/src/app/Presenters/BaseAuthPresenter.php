<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;

/*
 * Base Auth Presenter
 */

abstract class BaseAuthPresenter extends BasePresenter {

	/**
	 * Function to check if the current user is signed in. If so, continue to destination page. Otherwise, redirect to sign in.
	 *
	 * @return void     Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function startup(): void {

		parent::startup();

		if ($this->getUser()->isLoggedIn() === false && $this->getPresenter()->getName() !== 'Auth') {

			$this->flashmessage('Nejdříve se musíte přihlásit!', 'danger');
			$this->redirect('Auth:', ['backlink' => $this->storeRequest()]);

		}

		if ($this->getUser()->isLoggedIn() === true && $this->getPresenter()->getName() === 'Auth' && $this->getAction() !== 'signOut') {

			$this->redirect($this->getUser()->getIdentity()->getData()['employee'] ? 'Intra:Dashboard' : 'Homepage:');

		}

	}

}