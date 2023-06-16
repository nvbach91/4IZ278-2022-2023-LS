<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Service\PermissionService;
use App\Model\Service\UserService;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;


/**
 * Authenticator service
 *
 * Service which handles user authentication and authorization.
 */
final class MyAuthenticator implements Authenticator {

	private PermissionService $permissionService;
	private UserService $userService;
	private Passwords $passwords;

	public function __construct(PermissionService $permissionService, UserService $userService, Passwords $passwords) {

		$this->permissionService = $permissionService;
		$this->userService = $userService;
		$this->passwords = $passwords;

	}

	/**
	 * Function which authenticates user and assign permissions to the user.
	 *
	 * @param string $username id_user of the signing user.
	 * @param string $password Password of the signing user.
	 *
	 * @return SimpleIdentity               Nette simple identity containing authentication information.
	 * @throws AuthenticationException      If user does not exist, passwords do not match or user is blocked, the authentication exception will be thrown.
	 */
	public function authenticate(string $username, string $password): SimpleIdentity {

		$user = $this->userService->getUserByUsername($username);

		if ($user === null) {

			throw new AuthenticationException('Uživatel nebyl nalezen');

		}

		if (!$this->passwords->verify($password, $user->password)) {

			throw new AuthenticationException('Nesprávné heslo!');

		}

		if ($user->blocked) {

			throw new AuthenticationException('Váš účet je zablokován! Kontaktujte prosím administrátora.');

		}

		$permissions = $this->permissionService->getUserAuthPermissions($user->id_user);

		return new SimpleIdentity($user->id_user, $permissions, [
			'username' => $user->username,
			'display_name' => $user->display_name,
			'employee' => $user->employee,
			'mail' => $user->mail
		]);

	}

}