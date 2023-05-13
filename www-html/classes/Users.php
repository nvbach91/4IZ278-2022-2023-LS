<?php
// crossmile @ LXSX file:www-html/classes/Users.php

require_once(__DIR__ . '/../libs/utils.php');
require_once(__DIR__ . '/Emails.php');

class Users
{
	public $loggedUserId;
	public $userId;
	public $userToSanitize_arr;
	public $userSanitized_arr;
	public $userOAuth2;
	public $userSerial;

	protected $lastError;

	private $_config;
	private $_db;
	private $_app_acl;
	private $_eml;

	public function __construct($config, PDO $db, $app_acl) 
	{
		$this->_config = $config;
		$this->_db = $db;
		$this->_app_acl = $app_acl;
		$this->_eml = new Emails($config, $db);

		$this->loggedUserId = 0;
		$this->userId = 0;
		$this->lastError = '';
	}

	public function fetchUsers($filter_arr)
	{
		try {
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['users_r'], 0)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			$gender = '';
			$year = '';
			$search = '';
			$plus = 0;
			if (!empty($filter_arr['gender']) && in_array($filter_arr['gender'], ['1', '2'])) {
				$gender = ' AND t1.gender = ? ';
				$plus++;
			}
			if (!empty($filter_arr['year']) && preg_match('/^[1-2][0-9]{0,3}$/', $filter_arr['year'])) {
				$year = ' AND t1.year LIKE ? ';
				$plus++;
			}
			if (!empty($filter_arr['search']) && strlen($filter_arr['search']) <= 32)
				$search = ' AND (t1.last_name LIKE ? OR t1.first_name LIKE ? OR t1.club LIKE ?) ';
			$sql = sprintf('SELECT ' .
				't1.id, t1.email, t1.password, ' .
				't1.last_name, t1.first_name, t1.gender, t1.birthday, t1.year, t1.club, t1.acl, t1.status, ' .
				't1.modified, t1.created, ' .
				't2.name AS gender_name, ' .
				'COALESCE(t3.id, 0) AS oauth2_skmile, ' .
				'COALESCE(t4.id, 0) AS oauth2_google, ' .
				'COALESCE(t5.id, 0) AS oauth2_github ' .
				'FROM users t1 ' .
				'JOIN genders t2 ON t2.id = t1. gender ' .
				'LEFT JOIN users_oauth2 t3 ON t3.user = t1.id AND t3.service = "SKMILE" ' .
				'LEFT JOIN users_oauth2 t4 ON t4.user = t1.id AND t4.service = "GOOGLE" ' .
				'LEFT JOIN users_oauth2 t5 ON t5.user = t1.id AND t5.service = "GITHUB" ' .
				'WHERE 1 ' . $gender . $year . $search .
				'ORDER BY t1.last_name ASC, t1.first_name ASC, t1.gender ASC, t1.year DESC ' .
				'LIMIT ' . $this->_config['MAX_USERS_LIST']);
			$stmt = $this->_db->prepare($sql);
			if (!empty($gender))
				$stmt->bindValue(1, $filter_arr['gender'], PDO::PARAM_INT);
			if (!empty($year))
				$stmt->bindValue($plus, $filter_arr['year'] . '%', PDO::PARAM_STR);
			if (!empty($search)) {
				$stmt->bindValue(1 + $plus, '%' . $filter_arr['search'] . '%', PDO::PARAM_STR);
				$stmt->bindValue(2 + $plus, '%' . $filter_arr['search'] . '%', PDO::PARAM_STR);
				$stmt->bindValue(3 + $plus, '%' . $filter_arr['search'] . '%', PDO::PARAM_STR);
			}
			$stmt->execute();
			$registrations_arr = $stmt->fetchAll();
			$stmt = null;
			return ($registrations_arr);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function getUser()
	{
		try {
			if (empty($this->userId)) {
				$this->lastError = 'Chybí ID uživatele';
				return (false);
			}
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['users_r'], $this->userId)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			$sql = sprintf('SELECT ' .
				't1.id, t1.email, t1.password, ' .
				't1.last_name, t1.first_name, t1.gender, t1.birthday, t1.year, t1.club, t1.acl, t1.status, ' .
				't1.modified, t1.created, ' .
				't2.name AS gender_name, ' .
				'COALESCE(t3.id, 0) AS oauth2_skmile, ' .
				'COALESCE(t4.id, 0) AS oauth2_google, ' .
				'COALESCE(t5.id, 0) AS oauth2_github ' .
				'FROM users t1 ' .
				'JOIN genders t2 ON t2.id = t1. gender ' .
				'LEFT JOIN users_oauth2 t3 ON t3.user = t1.id AND t3.service = "SKMILE" ' .
				'LEFT JOIN users_oauth2 t4 ON t4.user = t1.id AND t4.service = "GOOGLE" ' .
				'LEFT JOIN users_oauth2 t5 ON t5.user = t1.id AND t5.service = "GITHUB" ' .
				'WHERE t1.id = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt = null;
			if (empty($user)) {
				$this->lastError = 'Neplatný uživatel';
				return (false);
			}
			return ($user);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function saveUser()
	{
		try {
			if (empty($this->userSanitized_arr)) {
				$this->lastError = 'Prázdné pole pro uložení';
				return (false);
			}
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['users_w'], $this->userId)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			
			$this->_db->beginTransaction();
			// Admin editable only by admin
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['admin'], 0)) { // not Admin
				$sql = sprintf('SELECT 1 FROM users WHERE id = ? AND (acl & ?) > 0 FOR UPDATE');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindValue(1, $this->userId, PDO::PARAM_INT);
				$stmt->bindValue(2, $this->_app_acl['admin'], PDO::PARAM_INT);
				$stmt->execute();
				$count = $stmt->rowCount();
				$stmt = null;
				if (!empty($count)) { // target user is admin
					$this->_db->rollBack();
					$this->lastError = 'Nelze editovat Administrátora';
					return (false);
				}
			}
			if (!$this->isUserOK()) {
				$this->_db->rollBack();
				return (false);
			}
			if (!$this->isGenderOK()) {
				$this->_db->rollBack();
				return (false);
			}
			if (!$this->isBirthdayOK()) {
				$this->_db->rollBack();
				return (false);
			}
			if (AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['admin'], 0)
				&& isset($this->userSanitized_arr['acl'])
			) {
				$acl = ' acl = ?, ';
				if ($this->loggedUserId == $this->userId) // cannot remove admin and login privileges for yourself
					$this->userSanitized_arr['acl'] = $this->userSanitized_arr['acl'] | $this->_app_acl['login'] | $this->_app_acl['admin'];
			} else
				$acl = '';
			$sql = sprintf('UPDATE users SET ' .
				'password = ?, ' .
				'last_name = ?, first_name = ?, gender = ?, ' .
				'birthday = ?, club = ?, ' . $acl .
				'modified = NOW() ' .
				'WHERE id = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userSanitized_arr['password'], PDO::PARAM_STR);
			$stmt->bindParam(2, $this->userSanitized_arr['last_name'], PDO::PARAM_STR);
			$stmt->bindParam(3, $this->userSanitized_arr['first_name'], PDO::PARAM_STR);
			$stmt->bindParam(4, $this->userSanitized_arr['gender'], PDO::PARAM_INT);
			$stmt->bindParam(5, $this->userSanitized_arr['birthday'], PDO::PARAM_STR);
			$stmt->bindParam(6, $this->userSanitized_arr['club'], PDO::PARAM_STR);
			$stmt->bindParam((!empty($acl) ? 8 : 7), $this->userId, PDO::PARAM_INT);
			if (!empty($acl))
				$stmt->bindValue(7, $this->userSanitized_arr['acl'], PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Uživatele se nepodařilo uložit, zkuste to za chvíli znovu';
				return (false);
			}
			$this->_db->commit();
			return (true);
		} catch (PDOException $e) {
			if ($this->_db->inTransaction())
				$this->_db->rollBack();
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function insertUser()
	{
		try {
			if (empty($this->userSanitized_arr)) {
				$this->lastError = 'Prázdné pole pro vložení';
				return (false);
			}
			$this->_db->beginTransaction();
			if (!$this->isEmailFree()) {
				$this->_db->rollBack();
				return (false);
			}
			$sql = sprintf('INSERT INTO users ' .
				'(email, password, last_name, first_name, gender, birthday, club, acl, status) ' .
				'VALUES ' .
				'(?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userSanitized_arr['email'], PDO::PARAM_STR);
			$stmt->bindParam(2, $this->userSanitized_arr['password'], PDO::PARAM_STR);
			$stmt->bindParam(3, $this->userSanitized_arr['last_name'], PDO::PARAM_STR);
			$stmt->bindParam(4, $this->userSanitized_arr['first_name'], PDO::PARAM_STR);
			$stmt->bindParam(5, $this->userSanitized_arr['gender'], PDO::PARAM_INT);
			$stmt->bindParam(6, $this->userSanitized_arr['birthday'], PDO::PARAM_STR);
			$stmt->bindParam(7, $this->userSanitized_arr['club'], PDO::PARAM_STR);
			$stmt->bindValue(8, (!empty($this->userOAuth2) ? 3 : 1), PDO::PARAM_STR);
			$stmt->bindValue(9, (!empty($this->userOAuth2) ? 2 : 0), PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Uživatele se nepodařilo vložit, zkuste to za chvíli znovu';
				return (false);
			}
			$this->userId = $this->_db->lastInsertId();
			if (!empty($this->userOAuth2)) {
				if (!$this->_insertOAuth2Serial())
					return (false);
				$this->_db->commit();
				$this->_eml->userId = $this->userId;
					if (!$this->_eml->emailUserReady()) {
						$this->lastError = $this->_eml->getLastError();
						if (empty($this->lastError))
							$this->lastError = ['db' => 'E-mail se nepodařilo odeslat'];
						return (false);
					}
			} else {
				if (!_insertConfirmationHash())
					return (false);
				$this->_db->commit();
				$this->_eml->userId = $this->userId;
				if (!$this->_eml->emailUserConfirm()) {
					$this->lastError = $this->_eml->getLastError();
					if (empty($this->lastError))
							$this->lastError = ['db' => 'E-mail se nepodařilo odeslat'];
					return (false);
				}
			}
			return (true);
		} catch (PDOException $e) {
			if ($this->_db->inTransaction())
				$this->_db->rollBack();
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}
	
	public function deleteUser()
	{
		try {
			if (empty($this->userToSanitize_arr)) {
				$this->lastError = 'Prázdné pole pro sanitizaci';
				return (false);
			}
			// ACL check
			if ($this->loggedUserId == $this->userId) {
				$this->lastError = 'Nelze mazat sám sebe';
				return (false);
			}
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['users_w'], 0)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			
			$this->_db->beginTransaction();
			// Admin deletable only by admin
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['admin'], 0)) { // not Admin
				$sql = sprintf('SELECT 1 FROM users WHERE id = ? AND (acl & ?) > 0 FOR UPDATE');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindValue(1, $this->userId, PDO::PARAM_INT);
				$stmt->bindValue(2, $this->_app_acl['admin'], PDO::PARAM_INT);
				$stmt->execute();
				$count = $stmt->rowCount();
				$stmt = null;
				if (!empty($count)) { // target user is admin
					$this->_db->rollBack();
					$this->lastError = 'Nelze smazat Administrátora';
					return (false);
				}
			}
			$sql = sprintf('DELETE FROM users WHERE id = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Uživatele se nepodařilo smazat, zkuste to za chvíli znovu';
				return (false);
			}
			$this->_db->commit();
			return (true);
		} catch (PDOException $e) {
			if ($this->_db->inTransaction())
				$this->_db->rollBack();
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function userUnpairOAuth2()
	{
		try {
			if (empty($this->userOAuth2)) {
				$this->lastError = 'Chybí OAuth2 služba';
				return (false);
			}
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['users_w'], $this->userId)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			$this->_db->beginTransaction();
			if (!$this->isUserOK()) {
				$this->_db->rollBack();
				return (false);
			}
			$sql = sprintf('DELETE FROM users_oauth2 WHERE user = ? AND service = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->userOAuth2, PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Párování uživatele s ' . $this->userOAuth2 . ' se nepodařilo odstranit';
				return (false);
			}
			$this->_db->commit();
			return (true);
		} catch (PDOException $e) {
			if ($this->_db->inTransaction())
				$this->_db->rollBack();
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function userPairOAuth2()
	{
		try {
			if (empty($this->userOAuth2)) {
				$this->lastError = 'Chybí OAuth2 služba';
				return (false);
			}
			if (empty($this->userSerial)) {
				$this->lastError = 'Chybí userSerial';
				return (false);
			}
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['users_w'], $this->userId)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			$this->_db->beginTransaction();
			if (!$this->isUserOK()) {
				$this->_db->rollBack();
				return (false);
			}
			if (!$this->_insertOAuth2Serial()) {
				$this->_db->rollBack();
				return (false);
			}
			$this->_db->commit();
			return (true);
		} catch (PDOException $e) {
			if ($this->_db->inTransaction())
				$this->_db->rollBack();
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function satinizeUserData()
	{
		if (empty($this->userToSanitize_arr)) {
			$this->lastError = 'Prázdné pole pro sanitizaci';
			return (false);
		}
		$this->userSanitized_arr['id'] = (isset($this->userToSanitize_arr['id']) ? htmlspecialchars(trim($this->userToSanitize_arr['id']), ENT_QUOTES) : 0);
		$this->userSanitized_arr['email'] = (isset($this->userToSanitize_arr['email']) ? filter_var(trim($this->userToSanitize_arr['email']), FILTER_SANITIZE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE)) : '');
		$this->userSanitized_arr['password'] = (isset($this->userToSanitize_arr['password']) ? $this->userToSanitize_arr['password'] : '');
		$this->userSanitized_arr['confirm_password'] = (isset($this->userToSanitize_arr['confirm_password']) ? $this->userToSanitize_arr['confirm_password'] : '');
		$this->userSanitized_arr['last_name'] = (isset($this->userToSanitize_arr['last_name']) ? htmlspecialchars(trim($this->userToSanitize_arr['last_name']), ENT_QUOTES) : '');
		$this->userSanitized_arr['first_name'] = (isset($this->userToSanitize_arr['first_name']) ? htmlspecialchars(trim($this->userToSanitize_arr['first_name']), ENT_QUOTES) : '');
		$this->userSanitized_arr['gender'] = (isset($this->userToSanitize_arr['gender']) ? htmlspecialchars(trim($this->userToSanitize_arr['gender']), ENT_QUOTES) : '');
		$this->userSanitized_arr['birthday'] = (isset($this->userToSanitize_arr['birthday']) ? htmlspecialchars(trim($this->userToSanitize_arr['birthday']), ENT_QUOTES) : '');
		$this->userSanitized_arr['club'] = (isset($this->userToSanitize_arr['club']) ? htmlspecialchars(trim($this->userToSanitize_arr['club']), ENT_QUOTES) : '');
		$this->userSanitized_arr['g-recaptcha-response'] = (isset($this->userToSanitize_arr['g-recaptcha-response']) ? $this->userToSanitize_arr['g-recaptcha-response'] : '');
		$this->userSanitized_arr['serial'] = (isset($this->userToSanitize_arr['serial']) ? $this->userToSanitize_arr['serial'] : '');
		$this->userSerial = $this->userSanitized_arr['serial'];
		if (isset($this->userToSanitize_arr['acl']))
			$this->userSanitized_arr['acl'] = $this->userToSanitize_arr['acl'];
		return (true);
	}

	public function validateUserData()
	{
		if (empty($this->userSanitized_arr)) {
			$this->lastError = 'Prázdné pole pro validaci';
			return (false);
		}
		// e-mail
		if (!filter_var($this->userSanitized_arr['email'], FILTER_VALIDATE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE)))
			$errors_arr['email'] = 'Zadejte prosím platný e-mail';
		// password
		if (empty($this->userSanitized_arr['password']) || strlen($this->userSanitized_arr['password']) < 6 || strlen($this->userSanitized_arr['password']) > 32)
			$errors_arr['password'] = 'Zadejte prosím platné heslo';
		// confirm password
		if (empty($this->userSanitized_arr['confirm_password']) || $this->userSanitized_arr['password'] != $this->userSanitized_arr['confirm_password'])
			$errors_arr['confirm_password'] = 'Zadejte prosím platné heslo pro kontrolu';
		// last name
		if (empty($this->userSanitized_arr['last_name']) || strlen($this->userSanitized_arr['last_name']) < 2 || strlen($this->userSanitized_arr['last_name']) > 32)
			$errors_arr['last_name'] = 'Zadejte prosím platné příjmení';
		// first name
		if (empty($this->userSanitized_arr['first_name']) || strlen($this->userSanitized_arr['first_name']) < 2 || strlen($this->userSanitized_arr['first_name']) > 32)
			$errors_arr['first_name'] = 'Zadejte prosím platné křestní jméno';
		// gender
		if (!isset($this->userSanitized_arr['gender']) || !in_array($this->userSanitized_arr['gender'], ['1', '2']))
			$errors_arr['gender'] = 'Vyberte prosím platné pohlaví';
		// birthday
		if (empty($this->userSanitized_arr['birthday']) || validateDateTime($this->userSanitized_arr['birthday'], 'd.m.Y'))
			$errors_arr['birthday'] = 'Vyberte prosím platné datum narození';
		// club
		if (empty($this->userSanitized_arr['club']) || strlen($this->userSanitized_arr['club']) < 2 || strlen($this->userSanitized_arr['club']) > 64)
			$errors_arr['first_name'] = 'Zadejte prosím platný klub';
		// acl
		if (isset($this->userSanitized_arr['acl']) && (!isInteger($this->userSanitized_arr['acl']) || $this->userSanitized_arr['acl'] < 0))
			$errors_arr['acl'] = 'Zadejte platná ACL';
		
		if (empty($errors_arr)) {
			return (true);
		} else {
			$this->lastError = $errors_arr;
			return (false);
		}
	}

	public function validateReCaptcha()
	{
		if (empty($this->userSanitized_arr['g-recaptcha-response'])) {
			$this->lastError = 'Chybí reCaptcha';
			return (false);
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
			'secret=' . $this->_config['GRECAPTCHA_KEY'] .
			'&response=' . $this->userSanitized_arr['g-recaptcha-response'] .
			'&remoteip=' . ($_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : ''));
		$result = curl_exec($ch);
		curl_close($ch);
		if (!empty($result)) {
			$response = json_decode($result, true);
			if (!empty($response['success']) && $response['success'] == 'true')
				$recaptcha = 1;
		}
		if (empty($recaptcha)) {
			$this->lastError = ['user' => 'Neplatná reCaptcha'];
			return (false);
		}
		return (true);
	}

	public function isUserOK()
	{
		try {
			if (empty($this->userId)) {
				$this->lastError = 'Chybí ID uživatele';
				return (false);
			}
			$sql = sprintf('SELECT 1 FROM users WHERE id = ? AND status = 2 FOR UPDATE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->lastError = 'Uživatel není ready';
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isEmailFree()
	{
		try {
			$sql = sprintf('SELECT 1 FROM users WHERE email = ? LOCK IN SHARE MODE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userSanitized_arr['email'], PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (!empty($count)) {
				$this->lastError = ['email' => 'E-mail už existuje'];
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isGenderOK()
	{
		try {
			$sql = sprintf('SELECT 1 ' .
				'FROM users t1 ' .
				'LEFT JOIN registrations t2 ON t2.user = t1.id ' .
				'WHERE t1.id = ? AND (t2.id IS NULL OR t1.gender = ?) ' .
				'LIMIT 1 ' .
				'FOR UPDATE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->userSanitized_arr['gender'], PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->lastError = ['gender' => 'Před změnou pohlaví se odhlašte ze všech závodů'];
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isBirthdayOK()
	{
		try {
			$sql = sprintf('SELECT 1 ' .
				'FROM users t1 ' .
				'LEFT JOIN registrations t2 ON t2.user = t1.id ' .
				'WHERE t1.id = ? AND (t2.id IS NULL OR t1.year = ?) ' .
				'LIMIT 1 ' .
				'FOR UPDATE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
			$stmt->bindValue(2, date('Y', strtotime($this->userSanitized_arr['birthday'])), PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->lastError = ['birthday' => 'Před změnou data narození se odhlašte ze všech závodů'];
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function fetchAll()
	{
		try {
			$sql = sprintf('SELECT ' .
				'id, email, password, ' .
				'last_name, first_name, gender, birthday, year, club, acl, status, ' .
				'modified, created ' .
				'FROM users ' .
				'ORDER BY last_name ASC, first_name ASC');
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			$users_arr = $stmt->fetchAll();
			$stmt = null;
			return ($users_arr);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	private function _insertConfirmationHash()
	{
		$i = 0;
		do {
			$hash = genRandomString(32);
			$sql = sprintf('SELECT 1 FROM users_confirmation_hashes WHERE hash = ? FOR UPDATE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $hash, PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			$i++;
		} while (!empty($count) && $i < 100);
		if ($i == 100) {
			$this->_db->rollBack();
			$this->lastError = 'Nepodařilo se vygenerovat hash, zkuste to za chvíli znovu';
			return (false);
		}
		$sql = sprintf('INSERT INTO users_confirmation_hashes (user, hash) VALUES (?, ?)');
		$stmt = $this->_db->prepare($sql);
		$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
		$stmt->bindParam(2, $hash, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->rowCount();
		$stmt = null;
		if (empty($count)) {
			$this->_db->rollBack();
			$this->lastError = 'Hash se nepodařilo vložit, zkuste to za chvíli znovu';
			return (false);
		}
		return (true);
	}

	private function _insertOAuth2Serial()
	{
		$sql = sprintf('INSERT INTO users_oauth2 (user, service, serial) VALUES (?, ?, ?)');
		$stmt = $this->_db->prepare($sql);
		$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
		$stmt->bindParam(2, $this->userOAuth2, PDO::PARAM_STR);
		$stmt->bindParam(3, $this->userSerial, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->rowCount();
		$stmt = null;
		if (empty($count)) {
			$this->_db->rollBack();
			$this->lastError = 'Serial se nepodařilo vložit, zkuste to za chvíli znovu';
			return (false);
		}
		return (true);
	}

	public function getLastError()
	{
		return ($this->lastError);
	}
}
?>