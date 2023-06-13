<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Service\PermissionService;
use App\Model\Service\UserService;
use Exception;
use Nette;

/**
 * Users presenter
 *
 * This presenter represents all user actions like blocking user, setting new permission, etc.
 */
final class UsersPresenter extends BaseEmployeesPresenter {

	private PermissionService $permissionService;
	private UserService $userService;

	public function __construct(PermissionService $permissionService, UserService $userService) {

		parent::__construct();

		$this->permissionService = $permissionService;
		$this->userService = $userService;

	}

	/**
	 * Function to check if logged user has necessary permission (admin.users) to access this resource. If no, redirect to dashboard.
	 *
	 * @return void     Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function startup(): void {

		parent::startup();

		if (!$this->getUser()->isInRole('admin.users')) {

			$this->flashMessage('Pro přístup do správy uživatelů nemáte potřebná oprávnění!', 'danger');
			$this->redirect('Intra:Dashboard');

		}

	}

	/**
	 * Function to handle request to block specified user.
	 *
	 * @param string $idUser id_user of the user which will be blocked.
	 *
	 * @return void                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function handleBlockUser(string $idUser): void {

		try {

			$this->userService->blockUser($idUser, $this->getUser()->getId());

		} catch (Exception $e) {

			$this->flashMessage($e->getMessage(), 'danger');
			$this->redirect('Users:Detail', $idUser);

		}

		$this->flashMessage('Uživatel byl úspěšně zablokován.', 'success');
		$this->redirect('Users:Detail', $idUser);

	}

	/**
	 * Function to handle request to unblock specified user.
	 *
	 * @param string $idUser id_user of the user which will be unblocked.
	 *
	 * @return void                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function handleUnblockUser(string $idUser): void {

		try {

			$this->userService->unblockUser($idUser);

		} catch (Exception $e) {

			$this->flashMessage($e->getMessage(), 'danger');
			$this->redirect('Users:Detail', $idUser);

		}

		$this->flashMessage('Uživatel byl úspěšně odblokován.', 'success');
		$this->redirect('Users:Detail', $idUser);

	}

	/**
	 * Function to handle request to show interface for add new permission to the user.
	 *
	 * @param string $idUser id_user of the user to whom permission will be assigned.
	 *
	 * @return void                 Function has no return value.
	 */
	public function handleNewPermission(string $idUser): void {

		$this->template->selectedUser = $this->userService->getUserById($idUser);
		$this->setView('detailNewPermission');

	}

	/**
	 * Function to handle request to remove specified permission from the specified user.
	 *
	 * @param string $idUser     id_user of the user from which the permission will be removed.
	 * @param string $permission Permission key which will be removed.
	 *
	 * @return void                     Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function handleRemovePermission(string $idUser, string $permission): void {

		try {

			$this->permissionService->removePermission($idUser, $permission, $this->getUser()->getId());

		} catch (Exception $e) {

			$this->flashMessage($e->getMessage(), 'danger');
			$this->redirect('Users:Detail', $idUser);

		}

		$this->flashMessage('Oprávnění bylo úspěšně odebráno.', 'success');
		$this->redirect('Users:Detail', $idUser);

	}

	/**
	 * Function to handle request to remove specified user.
	 *
	 * @param string $idUser id_user of the user which will be removed.
	 *
	 * @return void                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function handleRemoveUser(string $idUser): void {

		$user = $this->userService->getUserById($idUser);

		try {

			$this->userService->removeUser($idUser, $this->getUser()->getId());
			$this->flashMessage('Uživatel byl úspěšně odstraněn.', 'success');

		} catch (Exception $e) {

			$this->flashMessage($e->getMessage(), 'danger');

		}

		$this->redirect($user->employee ? 'Users:Employees' : 'Users:Customers');

	}

	/**
	 * Function to handle request to show interface for reset password of the specified user.
	 *
	 * @param string $idUser id_user of the user whose password will be retested.
	 *
	 * @return void                 Function has no return value.
	 */
	public function handleResetPassword(string $idUser): void {

		$this->template->selectedUser = $this->userService->getUserById($idUser);
		$this->setView('detailResetPassword');

	}

	/**
	 * Function to render default template with all customers.
	 *
	 * @return void        Function has no return value.
	 */
	public function renderCustomers(): void {

		$this->template->evidedUsers = $this->userService->getUsers(false);
		$this->setView('customers');

	}

	/**
	 * Function to render default template with all employees.
	 *
	 * @return void        Function has no return value.
	 */
	public function renderEmployees(): void {

		$this->template->evidedUsers = $this->userService->getUsers(true);
		$this->setView('employees');

	}

	/**
	 * Function to render detail of the specified user.
	 *
	 * @param string $idUser id_user of the user whose detail will be rendered.
	 *
	 * @return void                 Function has no return value.
	 */
	public function renderDetail(string $idUser): void {

		$this->template->selectedUser = $this->userService->getUserById($idUser);
		$this->template->assignedPermissions = $this->permissionService->getUserPermissions($idUser);

	}

	/**
	 * Function to handle submit event form request to create new user.
	 *
	 * @param Nette\Application\UI\Form $form Instance of form which contains submitted data about new user.
	 *
	 * @return void                                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function newUserFormSuccess(Nette\Application\UI\Form $form) {

		$values = $form->getValues();

		try {

			$idUser = $this->userService->newUser($values);

		} catch (Exception $e) {

			$this->flashMessage($e->getMessage(), 'danger');
			$this->redirect('Users:New');

		}

		$this->redirect('Users:Detail', $idUser);

	}

	/**
	 * Function to handle submit event form request to add new permission to the specified user.
	 *
	 * @param Nette\Application\UI\Form $form Instance of form which contains submitted data about new permission.
	 *
	 * @return void                                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function newPermissionFormSuccess(Nette\Application\UI\Form $form) {

		$values = $form->getValues();

		try {

			$this->permissionService->newUserPermission($values);

		} catch (Exception $e) {

			$this->flashMessage('Přiřazení oprávnění selhalo! Prosím, zkuste to znovu.', 'danger');
			$this->redirect('newPermission!');

		}

		$this->flashMessage('Oprávnění bylo úspěšně přiřazeno. Pokud jste oprávnění přiřadili sami sobě, musíte se odhlásit a přihlásit.', 'success');
		$this->setView('detail');

	}

	/**
	 * Function to handle submit event form request to reset specified user password.
	 *
	 * @param Nette\Application\UI\Form $form Instance of form which contains submitted data about user which to reset password for.
	 *
	 * @return void                                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function resetPasswordFormSuccess(Nette\Application\UI\Form $form) {

		$values = $form->getValues();

		try {

			$this->userService->resetPassword($values);

		} catch (Exception $e) {

			$this->flashMessage($e->getMessage(), 'danger');
			$this->redirect('resetPassword!');

		}

		$this->flashMessage('Heslo bylo úspěšně resetováno.', 'success');
		$this->setView('detail');

	}

	/**
	 * Function which creates component form which is used to create new user.
	 *
	 * @return Nette\Application\UI\Form      Form component from Nette Forms.
	 */
	protected function createComponentNewUserForm(): Nette\Application\UI\Form {

		$form = new Nette\Application\UI\Form();
		$form->addText('username', 'Uživatelské jméno')->setRequired();
		$form->addText('display_name', 'Zobrazované jméno')->setRequired();
		$form->addPassword('password', 'Heslo')->setRequired();
		$form->addPassword('password_again', 'Heslo znovu')->setRequired();
		$form->addSubmit('newUser', 'Vytvořit nového uživatele');
		$form->onSuccess[] = [$this, 'newUserFormSuccess'];

		return $form;

	}

	/**
	 * Function which creates component form which is used to add new permission to the specified user.
	 *
	 * @return Nette\Application\UI\Form        Form component from Nette Forms.
	 */
	protected function createComponentNewPermissionForm(): Nette\Application\UI\Form {

		$form = new Nette\Application\UI\Form();
		$form->addSelect('permission', 'Oprávnění', array_column($this->permissionService->getUserAvailablePermissions($this->getParameter('idUser')), 'description', 'permission'));
		$form->addSubmit('newPermission', 'Přiřadit oprávnění');
		$form->addHidden('id_user', $this->getParameter('idUser'));
		$form->onSuccess[] = [$this, 'newPermissionFormSuccess'];

		return $form;

	}

	/**
	 * Function which creates component form which is used to reset password of the specified user.
	 *
	 * @return Nette\Application\UI\Form        Form component from Nette Forms.
	 */
	protected function createComponentResetPasswordForm(): Nette\Application\UI\Form {

		$form = new Nette\Application\UI\Form();
		$form->addPassword('password', 'Heslo')->setRequired();
		$form->addPassword('password_again', 'Heslo znovu')->setRequired();
		$form->addHidden('id_user', $this->getParameter('id_user'));
		$form->addSubmit('resetPassword', 'Resetovat heslo');
		$form->onSuccess[] = [$this, 'resetPasswordFormSuccess'];

		return $form;

	}

}
