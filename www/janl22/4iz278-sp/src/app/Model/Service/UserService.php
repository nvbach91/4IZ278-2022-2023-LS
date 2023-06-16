<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Entity\User;
use Exception;
use Nette;
use Nette\Utils\ArrayHash;

/**
 * User service
 *
 * Service containing methods for work with User table.
 */
final class UserService extends BaseService {

	/**
	 * Function which blocks sign-in of the specified user.
	 *
	 * @param string $idUser             id_user of the user whose sign-in will be blocked.
	 * @param string $currentUserid_user id_user of the current signed user.
	 *
	 * @return void                           Function has no return value.
	 * @throws Exception                      If user try to block himself, the exception will be thrown.
	 */
	public function blockUser(string $idUser, string $currentUserid_user): void {

		if ($idUser === $currentUserid_user) {

			throw new Exception('Nemůžeš zablokovat sám sebe!');

		}

		$this->databaseE->table('user_account')->where('id_user = ?', $idUser)->update(['blocked' => true]);

	}

	/**
	 * Function which unblocks sign-in of the specified user.
	 *
	 * @param string $idUser id_user of the user whose sign-in will be blocked.
	 *
	 * @return void                           Function has no return value.
	 */
	public function unblockUser(string $idUser): void {

		$this->databaseE->table('user_account')->where('id_user = ?', $idUser)->update(['blocked' => false]);

	}

	/**
	 * Function to get specified user.
	 *
	 * @param string $username Username of the user which will be returned.
	 *
	 * @return User|null            If user exists, returns instance of the User Class. Otherwise, returns null.
	 */
	public function getUserByUsername(string $username): ?User {

		return User::create($this->databaseE->table('user_account')->where('username', $username)->fetch());

	}

	/**
	 * Function to get specified user.
	 *
	 * @param string $columnName Name of the column to which param id_user will be checked.
	 * @param string $idUser     ID of the user which will be returned.
	 *
	 * @return User|null            If user exists, returns instance of the User Class. Otherwise, returns null.
	 */
	public function getUserBy(string $columnName, string $idUser): ?User {

		return User::create($this->databaseE->table('user_account')->where($columnName, $idUser)->fetch());

	}

	/**
	 * Function to get all users.
	 *
	 * @return array          If users exists, returns array of these users as instance of the User Class. Otherwise, returns null.
	 */
	public function getUsers(bool $isEmployee = false): array {

		$usersResponse = [];
		$users = $this->databaseE->table('user_account')->where('employee', $isEmployee)->order('display_name')->fetchAll();

		foreach ($users as $user) {
			$usersResponse[] = User::create($user);
		}

		return $usersResponse;

	}

	/**
	 * Function which creates a new user in the system.
	 *
	 * @param ArrayHash $data Data from the form 'NewUserForm'.
	 *
	 * @return string               id_user of the created user.
	 * @throws Exception            If password does not match or user already exists, the exception will be thrown.
	 */
	public function newUser(ArrayHash $data, bool $oAuth = false, string $oAuthProvider = null): string {

		if (!$oAuth) {

			if ($data->password !== $data->password_again) {

				throw new Exception('Zadaná hesla se neshodují!');

			}

		}

		if ($oAuth) {
			$user = match ($oAuthProvider) {
				'facebook' => $this->databaseE->table('user_account')->where('id_facebook', $data->id)->fetch(),
			};
		} else {
			$user = $this->databaseE->table('user_account')->where('username', $data->username)->fetch();
		}

		if ($user !== null) {

			throw new Nette\Database\UniqueConstraintViolationException('Uživatel již existuje!');

		}

		if ($oAuth) {

			$result = match ($oAuthProvider) {
				'facebook' => $this->databaseC->query("INSERT INTO user_account (mail, id_facebook, display_name) VALUES (?, ?, ?) RETURNING id_user;", $data->email, $data->id, $data->first_name . ' ' . $data->last_name)
			};

		} else {

			$passwordHash = $this->passwords->hash($data->password);
			$result = $this->databaseC->query("INSERT INTO user_account (username, password, display_name, employee) VALUES (?, ?, ?, true) RETURNING id_user;", $data->username, $passwordHash, $data->display_name);

		}

		return $result->fetch()->id_user;

	}

	/**
	 * @throws Exception
	 */
	public function updateUserOAuthInfo(ArrayHash $data, string $oAuthProvider): void {

		match ($oAuthProvider) {

			'facebook' => $this->databaseC->query("UPDATE user_account SET id_facebook = ? WHERE mail = ?;", $data->id, $data->email)

		};

	}

	/**
	 * Function which remove user from the system.
	 *
	 * @param string $idUser id_user of the user which will be removed.
	 * @param string $currentUserIdUser
	 *
	 * @return void                             Function has no return value.
	 * @throws Exception If user try to remove himself, the exception will be thrown.
	 */
	public function removeUser(string $idUser, string $currentUserIdUser): void {

		$user = $this->getUserById($idUser);

		if (!$user->deletable) {

			throw new Exception('Tohoto uživatele nelze odstranit!');

		}

		if ($user->id_user === $currentUserIdUser) {

			throw new Exception('Nemůžeš odstranit sám sebe!');

		}

		$this->databaseE->table('user_account')->where('id_user = ?', $idUser)->delete();

	}

	/**
	 * Function which reset the specified user password.
	 *
	 * @param ArrayHash $data Data from the form 'ResetPasswordForm'.
	 *
	 * @return void                 Function has no return value.
	 * @throws Exception            If password does not match, the exception will be thrown.
	 */
	public function resetPassword(ArrayHash $data): void {

		if ($data->password !== $data->password_again) {

			throw new Exception('Zadaná hesla se neshodují!');

		}

		$passwordHash = $this->passwords->hash($data->password);
		$this->databaseE->table('user_account')->where('id_user = ?', $data['id_user'])->update(['password' => $passwordHash]);

	}

	/**
	 * @throws Exception when new passwords does not match or the current password does not match.
	 */
	public function updatePassword(ArrayHash $data): void {

		$user = $this->getUserById($data->id_user);

		if (!$this->passwords->verify($data->current_password, $user->password)) {

			throw new Exception('Současné heslo je nesprávné!', 1001);

		}

		if ($data->password !== $data->password_again) {

			throw new Exception('Zadaná hesla se neshodují!', 1002);

		}

		$passwordHash = $this->passwords->hash($data['password']);
		$this->databaseE->table('user_account')->where('id_user = ?', $data['id_user'])->update(['password' => $passwordHash]);

	}

	/**
	 * Function to get specified user.
	 *
	 * @param string $idUser ID of the user which will be returned.
	 *
	 * @return User|null            If user exists, returns instance of the User Class. Otherwise, returns null.
	 */
	public function getUserById(string $idUser): ?User {

		return User::create($this->databaseE->table('user_account')->where('id_user', $idUser)->fetch());

	}

}