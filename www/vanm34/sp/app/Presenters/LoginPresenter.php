<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Models\UserFactory;
use App\Security\UserAuthenticator;

final class LoginPresenter extends Nette\Application\UI\Presenter
{
	public function actionSignIn()
	{
		$this->setLayout('Login.login');
	}	

	protected function createComponentLoginForm(): Nette\Application\UI\Form
	{

		$form = new Nette\Application\UI\Form();

		$form->addText('username', 'Username:')
			->setRequired('Please enter your username.');
		$form->addPassword('password', 'Password:')
			->setRequired('Please enter your password.');
		$form->addSubmit('submit', 'Log in');

		$form->onSuccess[] = [$this, 'LoginSuccess'];
		
		return $form;
	}

	public function LoginSuccess(Nette\Application\UI\Form $form): void
	{
		//rozpracovaný Login, nestihl jsem dodělat
		var_dump($form->getValues());
	}

}