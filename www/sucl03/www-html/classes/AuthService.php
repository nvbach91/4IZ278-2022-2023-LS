<?php
// crossmile @ LXSX file:www-html/classes/AuthService.php

require_once(__DIR__ . '/../libs/utils.php');

class AuthService
{
	public $loginType;
	public $email;
	public $password;
	public $serial;

	protected $user_is_logged_in;
	protected $lastError;

	private $_config;
	private $_db;
	private $_user;
	private $_login_delay;

	public function __construct($config, PDO $db) 
	{
		$this->_config = $config;
		$this->_db = $db;
		$this->_login_delay = 1;

		$this->lastError = 'Unknown';

		if (session_status() !== PHP_SESSION_ACTIVE)
			$this->secSessionStart();
	}

	public function secSessionStart()
	{
		$this->_prepareSession();
		session_start();
		return (true);
	}

	public function login()
	{
		if ($this->loginType == 'SKMILE')
			$user = $this->_checkOAuth2Serial($this->loginType);
		else if ($this->loginType == 'GOOGLE')
			$user = $this->_checkOAuth2Serial($this->loginType);
		else if ($this->loginType == 'GITHUB')
			$user = $this->_checkOAuth2Serial($this->loginType);
		else //credentials
			$user = $this->_checkCredentials();

		if ($user) {
			$this->user_is_logged_in = true;
			$this->_user = $user;
			// setup session vars
			$_SESSION['user_is_logged_in'] = true;
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['user_email'] = $user['email'];
			$_SESSION['user_acl'] = $user['acl'];
			$_SESSION['user_year'] = $user['year'];
			$_SESSION['user_gender'] = $user['gender'];
			$_SESSION['user_oauth2'] = (!empty($user['oauth2']) ? $user['oauth2'] : '');
			$_SESSION['login_string'] = hash('sha512', $user['email'] . $user['password'] . (!empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'eUA'));
			$_SESSION['user_access_time'] = time();
			// store login to DB
			$this->_storeLogin();
			return ($user);
		} else {
			$this->user_is_logged_in = false;
			// store failed login to DB
			$this->_storeLogin();
			if (!preg_match('/(SKMILE|GOOGLE|GITHUB)/', $this->loginType))
				$this->_loginDelay();
			return (false);
		}
	}

	public function logout()
	{
		if (isset($_SESSION)) {
			$_SESSION = array();
			session_regenerate_id(true);
		}
		$this->user_is_logged_in = false;
	}

	public function loginCheck()
	{
		try {
			$ret = false;
			if (isset($_SESSION['user_id'], $_SESSION['user_email'], $_SESSION['login_string'])) {
				$sql = sprintf('SELECT id, email, password, acl FROM users WHERE id = ? AND email = ?');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(1, $_SESSION['user_id'], PDO::PARAM_INT);
				$stmt->bindParam(2, $_SESSION['user_email'], PDO::PARAM_STR);
				$stmt->execute();
				if (!empty($stmt->rowCount())) {
					$user = $stmt->fetch(PDO::FETCH_ASSOC);
					$login_check = hash('sha512', $user['email'] . $user['password'] . (!empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'eUA'));
					if (hash_equals($login_check, $_SESSION['login_string'])) {
						$_SESSION['user_acl'] = $user['acl'];
						$ret = true;
					} else
						$this->lastError = 'Neplatné heslo';
				} else
					$this->lastError = 'Neplatný uživatel';
			} else
				$this->lastError = 'Neplatná data';
			return ($ret);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function loginTimeoutCheck()
	{
		global $config;
		if (empty($_SESSION['user_access_time']) || $_SESSION['user_access_time'] < (time() - (($config['LOGIN_TIMEOUT'] + 1) * 60))) {
			$this->lastError = 'Sezení vypršelo';
			return (false);
		}
		$this->updateAccessTime();
		return (true);
	}

	public function updateAccessTime()
	{
		$_SESSION['user_access_time'] = time();
	}
	
	public function isLogged()
	{
		return (isset($_SESSION['user_is_logged_in']) && $_SESSION['user_is_logged_in'] === true);
	}

	public function aclCheck($_required_acl)
	{
		if (empty($_SESSION['user_id']))
			return (false);
		if (!self::aclCheckCross($_SESSION['user_id'], $_required_acl, 0)) {
			$this->lastError = 'Nedostatečná oprávnění';
			return (false);
		}
		return (true);
	}

	public static function aclCheckCross($_logged_user_id, $_required_acl, $_user_id)
	{
		if (empty($_logged_user_id))
			return (false);
		if (!empty($_user_id) && $_user_id == $_logged_user_id)
			return (true);
		if (empty($_SESSION['user_acl']) || !($_required_acl & $_SESSION['user_acl']))
			return (false);
		return (true);
	}

	public function getUser()
	{
		if (empty($this->_user) && !empty($_SESSION['user_is_logged_in'])) {
			$this->_user['user_is_logged_in'] = $_SESSION['user_is_logged_in'];
			$this->_user['user_id'] = $_SESSION['user_id'];
			$this->_user['user_email'] = $_SESSION['user_email'];
			$this->_user['user_acl'] = $_SESSION['user_acl'];
			$this->_user['user_year'] = $_SESSION['user_year'];
			$this->_user['user_gender'] = $_SESSION['user_gender'];
			$this->_user['user_oauth2'] = (!empty($_SESSION['user_oauth2']) ? $_SESSION['user_oauth2'] : '');
			$this->_user['login_string'] = $_SESSION['login_string'];
			$this->_user['user_access_time'] = $_SESSION['user_access_time'];
			if (!empty($_SESSION['user_oauth2']))
				$this->_user['user_oauth2'] = $_SESSION['user_oauth2'];
		}
		return ($this->_user);
	}

	public function getUserIsLoggedIn()
	{
		return ($this->user_is_logged_in);
	}

	public function getLastError()
	{
		return ($this->lastError);
	}

	private function _prepareSession()
	{
		session_name('crossmile_sec_session_id');
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params([
			'lifetime' => $cookieParams['lifetime'],
			'path' => '/',
			'secure' => true,
			'httponly' => true,
			'samesite' => 'None'
		]);
		return (true);
	}

	private function _loginDelay()
	{
		sleep($this->_login_delay);
	}

	private function _checkCredentials()
	{
		try {
			$sql = sprintf('SELECT id, email, password, acl, year, gender ' .
				'FROM users ' .
				'WHERE email = ? AND status > 0 '.
				'LIMIT 1');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->email, PDO::PARAM_STR);
			$stmt->execute();
			if (!empty($stmt->rowCount())) {
				$user = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($this->password == $user['password']) {
					$stmt = null;
					return ($user);
				} else
					$this->lastError = 'Neplatné heslo';
			} else
				$this->lastError = 'Neplatný uživatel';
			$stmt = null;
			return (false);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	private function _checkOAuth2Serial($type)
	{
		try {
			$this->password = $this->serial;
			$sql = sprintf('SELECT ' .
				't2.id, t2.email, t2.password, t2.acl, t2.year, t2.gender ' .
				'FROM users_oauth2 t1 ' .
				'JOIN users t2 ON t2.id = t1.user ' .
				'WHERE t1.service = ? AND t1.serial = ? AND t2.status > 0 ' .
				'LIMIT 1');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $type, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->serial, PDO::PARAM_STR);
			$stmt->execute();
			if (!empty($stmt->rowCount())) {
				$user = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($this->email == $user['email']) {
					$stmt = null;
					$user['oauth2'] = $type;
					return ($user);
				} else
					$this->lastError = 'Neplatný e-mail';
			} else
				$this->lastError = 'Neplatný uživatel';
			$stmt = null;
			return (false);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	private function _storeLogin()
	{
		try {
			$_ip_addr = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
			$_port = filter_input(INPUT_SERVER, 'REMOTE_PORT', FILTER_VALIDATE_INT);
			if ($this->user_is_logged_in) {
				$sql = sprintf('INSERT INTO users_logins ' .
					'(ip_addr, port, login_type, user) ' .
					'VALUES ' .
					'(?, ?, ?, ?)');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(4, $this->_user['id'], PDO::PARAM_INT);
			} else {
				$sql = sprintf('INSERT INTO users_logins_failed ' .
					'(ip_addr, port, login_type, username, password) ' .
					'VALUES ' .
					'(?, ?, ?, ?, ?)');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(4, $this->email, PDO::PARAM_STR);
				$stmt->bindValue(5, (!empty($this->password) ? $this->password : ''), PDO::PARAM_STR);
			}
			$stmt->bindParam(1, $_ip_addr, PDO::PARAM_STR);
			$stmt->bindParam(2, $_port, PDO::PARAM_INT);
			$stmt->bindValue(3, (!empty($this->loginType) ? $this->loginType : 'www'), PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			return ($count);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}
}
?>