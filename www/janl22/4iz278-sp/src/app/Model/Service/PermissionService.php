<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Entity\Permission;
use Exception;
use Nette;
use Nette\Utils\ArrayHash;

/**
 * Permission service
 *
 * Service containing methods for work with Permission table.
 */
final class PermissionService extends BaseService {

	use Nette\SmartObject;

	/**
	 * Function to get permission keys of the signing user. Only to create a Nette simple identity.
	 *
	 * @param string $idUser id_user of the user whose permissions will be returned.
	 *
	 * @return array                Array of permission keys.
	 */
	public function getUserAuthPermissions(string $idUser): array {

		return $this->databaseC->query("SELECT permission FROM user_permission WHERE id_user = '$idUser';")->fetchPairs();

	}

	/**
	 * Function to get all available permissions for the specified user.
	 *
	 * @param string $idUser id_user of the user whose permissions will be returned.
	 *
	 * @return array                If permissions exists, returns array of these permissions as instances of the Permission Class. Otherwise, returns an empty array.
	 */
	public function getUserAvailablePermissions(string $idUser): array {

		$permissionsResponse = [];
		$permissions = $this->getPermissions();
		$userPermissions = $this->getUserPermissions($idUser);

		foreach ($permissions as $permission) {

			if (!in_array($permission, $userPermissions)) {
				$permissionsResponse[] = $permission;
			}

		}

		return $permissionsResponse;

	}

	/**
	 * Function to get all available permissions.
	 *
	 * @return array        If permissions exists, returns array of these permissions as instances of the Permission Class. Otherwise, returns an empty array.
	 */
	public function getPermissions(): array {

		$permissionsResponse = [];
		$permissions = $this->databaseE->table('permission')->fetchAll();

		foreach ($permissions as $permission) {
			$permissionsResponse[] = Permission::create($permission);
		}

		return $permissionsResponse;

	}

	/**
	 * Function to get all assigned permissions for the specified user.
	 *
	 * @param string $idUser id_user of the user whose permissions will be returned.
	 *
	 * @return array                If permissions exists, returns array of these permissions as instances of the Permission Class. Otherwise, returns an empty array.
	 */
	public function getUserPermissions(string $idUser): array {

		$permissionsResponse = [];
		$userPermissions = $this->databaseE->table('user_permission')->where('id_user', $idUser)->fetchAll();

		foreach ($userPermissions as $userPermission) {
			$permissionsResponse[] = Permission::create($userPermission->ref('permission', 'permission'));
		}

		return $permissionsResponse;

	}

	/**
	 * Function which assign selected permission to the specified user.
	 *
	 * @param ArrayHash $data Data from the form 'NewPermissionForm'.
	 *
	 * @return void                 Function has no return value.
	 */
	public function newUserPermission(ArrayHash $data): void {

		$this->databaseE->table('user_permission')->insert($data);

	}

	/**
	 * Function which remove specified permission from the specified user.
	 *
	 * @param string $idUser             id_user of the user from which permission will be removed.
	 * @param string $permission         Key of the permission which will be removed.
	 * @param string $currentUserid_user id_user of the current signed user.
	 *
	 * @return void                             Function has no return value.
	 * @throws Exception                        If user try to remove himself permission for administering users (and permissions), the exception will be thrown.
	 */
	public function removePermission(string $idUser, string $permission, string $currentUserid_user): void {

		if ($idUser === $currentUserid_user && $permission === 'admin.users') {

			throw new Exception('Sám sobě nemůžeš odebrat oprávnění pro správu oprávnění!');

		}

		$this->databaseE->table('user_permission')->where('id_user = ? AND permission = ?', $idUser, $permission)->delete();

	}

}