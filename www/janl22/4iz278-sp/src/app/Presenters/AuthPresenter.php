<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\FacebookAuthenticator;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Nette;
use Nette\Application\AbortException;
use Nette\Application\Attributes\Persistent;

/*
 * Admin Presenter
 *
 * This presenter represents admin sing in/out pages
 */

final class AuthPresenter extends BaseAuthPresenter {

	#[Persistent]
	public string $backlink = '';

	private FacebookAuthenticator $facebookAuthenticator;

	public function __construct(FacebookAuthenticator $facebookAuthenticator) {

		parent::__construct();

		$this->facebookAuthenticator = $facebookAuthenticator;

	}

	/**
	 * @throws Exception
	 */
	public function actionFacebookLogin(): void {

		$this->getSession()->getSection('facebookLoginBacklink')->set('facebookLoginBacklink', $this->backlink);

		try {

			$this->facebookAuthenticator->facebookLogin();

		} catch (Exception $e) {

			$this->flashMessage($e->getMessage());

		}

		$this->redirect('Homepage:Default');

	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function actionFacebookAuthCallback(): void {

		try {

			$this->getUser()->login($this->facebookAuthenticator->facebookLoginCallback());

		} catch (Exception $e) {

			$this->flashMessage($e->getMessage(), 'danger');
			$this->redirect('Auth:Customer');

		}

		$this->restoreRequest($this->getSession()->getSection('facebookLoginBacklink')->get('facebookLoginBacklink'));
		$this->redirect('Homepage:');

	}

	/**
	 * Function to handle sign out request and redirect user to sign in page.
	 *
	 * @return void                                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	#[NoReturn] public function actionSignOut(): void {

		$this->getSession()->destroy();
		$this->getUser()->logout(true);
		$this->flashMessage('Odhlášení proběhlo úspěšně.', 'success');
		$this->redirect('Auth:');

	}

	/**
	 * Function to handle submit event form request to sign in the user.
	 *
	 * @param Nette\Application\UI\Form $form Instance of form which contains submitted data about signing user.
	 *
	 * @return void                                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function signInFormSuccess(Nette\Application\UI\Form $form): void {

		$values = $form->getValues();

		try {

			$this->getUser()->login($values->id_user, $values->password);

		} catch (Nette\Security\AuthenticationException $e) {

			$this->flashMessage($e->getMessage(), 'danger');
			$this->redirect('Auth:Employee');

		}

		$this->restoreRequest($this->backlink);
		$this->redirect('Intra:Dashboard');

	}

	/**
	 * Function which creates component form which is used for user sign in.
	 *
	 * @return Nette\Application\UI\Form    Form component from Nette Forms.
	 */
	protected function createComponentSignInForm(): Nette\Application\UI\Form {

		$form = new Nette\Application\UI\Form();
		$form->addText('id_user', 'Uživatelské jméno')->setRequired('Zadejte uživatelské jméno!');
		$form->addPassword('password', 'Heslo')->setRequired('Zadejte heslo!');
		$form->addSubmit('signIn', 'Přihlásit se');
		$form->onSuccess[] = [$this, 'signInFormSuccess'];

		return $form;

	}

}
