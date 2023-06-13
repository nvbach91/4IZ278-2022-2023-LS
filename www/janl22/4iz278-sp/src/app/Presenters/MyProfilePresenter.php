<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Service\PermissionService;
use App\Model\Service\UserService;
use Exception;
use Nette;
use Nette\Application\UI\Form;

final class MyProfilePresenter extends BaseAuthPresenter {

	private PermissionService $permissionService;
	private UserService $userService;

	public function __construct(PermissionService $permissionService, UserService $userService) {

		parent::__construct();

		$this->permissionService = $permissionService;
		$this->userService = $userService;

	}

	public function renderDefault(): void {

		$this->template->selectedUser = $this->userService->getUserById($this->getUser()->getId());
		$this->template->assignedPermissions = $this->permissionService->getUserPermissions($this->getUser()->getId());

	}

	public function handleUpdatePassword(): void {

		$this->template->selectedUser = $this->userService->getUserById($this->getUser()->getId());
		$this->setView('updatePassword');
	}

	/**
	 * Function to handle submit event form request to reset specified user password.
	 *
	 * @param Form $form Instance of form which contains submitted data about user which to reset password for.
	 *
	 * @return void                                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function updatePasswordFormSuccess(Form $form): void {

		try {

			$this->userService->updatePassword($form->getValues());

		} catch (Exception $e) {

			switch ($e->getCode()) {

				case 1001:
					//$form['current_password']->addError($e->getMessage());
					$this->flashMessage($e->getMessage(), 'danger');
					break;
				case 1002:
					//$form['password']->addError($e->getMessage());
					//$form['password_again']->addError($e->getMessage());
					$this->flashMessage($e->getMessage(), 'danger');
					break;
				default:
					//$form->addError('Neznámá chyba');
					$this->flashMessage('Neznámá chyba', 'danger');

			}

			$this->redirect('updatePassword!');

		}

		$this->flashMessage('Heslo bylo úspěšně změněno a byl/a jste odhlášen/a. Prosíme, přihlaste se znovu.', 'success');
		$this->getUser()->logout();
		$this->redirect('Auth:');

	}

	protected function createComponentUpdatePasswordForm(): Form {

		$form = new Form();
		$form->addPassword('current_password', 'Současné heslo')->setRequired();
		$form->addPassword('password', 'Heslo')->setRequired();
		$form->addPassword('password_again', 'Heslo znovu')->setRequired();
		$form->addHidden('id_user', $this->getUser()->getId());
		$form->addSubmit('updatePassword', 'Změnit heslo');
		$form->onSuccess[] = [$this, 'updatePasswordFormSuccess'];

		return $form;

	}

}
