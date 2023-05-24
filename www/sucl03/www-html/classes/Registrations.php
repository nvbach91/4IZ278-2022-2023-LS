<?php
// crossmile @ LXSX file:www-html/classes/Registrations.php

require_once(__DIR__ . '/Emails.php');

class Registrations
{
	public $loggedUserId;
	public $raceId;
	public $disciplineId;
	public $registrationId;
	public $registrationNote;
	public $userId;
	public $showOldRaces;

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
		$this->showOldRaces = 0;
		$this->lastError = '';
	}

	public function registerUser()
	{
		try {
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['register'], 0)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['registrations_w'], $this->userId)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			$this->_db->beginTransaction();
			if (!$this->isUserRegisterable()) {
				$this->_db->rollBack();
				return (false);
			}
			$sql = sprintf('INSERT INTO registrations (user, discipline, note) VALUES (?, ?, ?)');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->disciplineId, PDO::PARAM_INT);
			$stmt->bindValue(3, (!empty($this->registrationNote) ? $this->registrationNote : NULL), PDO::PARAM_STR);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Uživatele se nepodařilo zaregistrovat, zkuste to za chvíli znovu';
				return (false);
			}
			$this->_db->commit();
			$this->_eml->userId = $this->userId;
			$this->_eml->disciplineId = $this->disciplineId;
			if (!$this->_eml->emailUserRegistered()) {
				$this->lastError = $this->_eml->getLastError();
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			if ($this->_db->inTransaction())
				$this->_db->rollBack();
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isUserRegisterable()
	{
		try {
			if (!$this->isDiscipline())
				return (false);
			if ($this->isUserRegistered()) {
				$this->lastError = 'Uživatel je již přihlášen';
				return (false);
			}
			if (!$this->isRegistrationOpen())
				return (false);
			if (!$this->isUserOK())
				return (false);
			if (!$this->isGenderOK())
				return (false);
			if (!$this->isYearOK())
				return (false);
			if (!$this->isLimitOK())
				return (false);
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function unregisterUser()
	{
		try {
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['register'], 0)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['registrations_w'], $this->userId)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			$this->_db->beginTransaction();
			if (!$this->isRegistration()) {
				$this->_db->rollBack();
				return (false);
			}
			if (!$this->isUserRegistered()) {
				$this->_db->rollBack();
				return (false);
			}
			if (!$this->isUnregistrationOpen()) {
				$this->_db->rollBack();
				return (false);
			}
			$sql = sprintf('DELETE FROM registrations WHERE id = ? AND user = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->registrationId, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->userId, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Uživatele se nepodařilo odregistrovat, zkuste to za chvíli znovu';
				return (false);
			}
			$this->_db->commit();
			$this->_eml->userId = $this->userId;
			$this->_eml->disciplineId = $this->disciplineId;
			if (!$this->_eml->emailUserUnregistered()) {
				$this->lastError = $this->_eml->getLastError();
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			if ($this->_db->inTransaction())
				$this->_db->rollBack();
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isDiscipline()
	{
		try {
			if (empty($this->raceId)) {
				$this->lastError = 'Chybí ID závodu';
				return (false);
			}
			if (empty($this->disciplineId)) {
				$this->lastError = 'Chybí ID disciplíny';
				return (false);
			}
			$sql = sprintf('SELECT 1 ' .
				'FROM disciplines t1 ' .
				'JOIN races t2 ON t2.id = t1.race ' .
				'WHERE t1.id = ? AND t2.id= ? ' .
				'LIMIT 1 ' .
				'LOCK IN SHARE MODE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->disciplineId, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->raceId, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->lastError = 'Disciplína neexistuje';
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isRegistration()
	{
		try {
			if (empty($this->registrationId)) {
				$this->lastError = 'Chybí ID registrace';
				return (false);
			}
			$sql = sprintf('SELECT user, discipline ' .
				'FROM registrations ' .
				'WHERE id = ? ' .
				'LIMIT 1 ' .
				'LOCK IN SHARE MODE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->registrationId, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			if (empty($count)) {
				$stmt = null;
				$this->lastError = 'Registrace neexistuje';
				return (false);
			}
			$registration = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt = null;
			$this->userId = $registration['user'];
			$this->disciplineId = $registration['discipline'];
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isRegistrationOpen()
	{
		try {
			if (!empty($this->disciplineId)) {
				$sql = sprintf('SELECT 1 ' .
					'FROM disciplines t1 ' .
					'JOIN races t2 ON t2.id = t1.race ' .
					'WHERE t1.id = ? AND t2.registration_open <= NOW() AND t2.registration_close >= NOW() ' .
					'LIMIT 1 ' .
					'LOCK IN SHARE MODE');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(1, $this->disciplineId, PDO::PARAM_INT);
			} else if (!empty($this->raceId)) {
				$sql = sprintf('SELECT 1 ' .
					'FROM races ' .
					'WHERE id = ? AND registration_open <= NOW() AND registration_close >= NOW() ' .
					'LIMIT 1 ' .
					'LOCK IN SHARE MODE');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(1, $this->raceId, PDO::PARAM_INT);
			} else {
				$this->lastError = 'Chybí ID disciplíny nebo závodu';
				return (false);
			}
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->lastError = 'Registrace není otevřena';
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isUnregistrationOpen()
	{
		try {
			if (!empty($this->registrationId)) {
				$sql = sprintf('SELECT 1 ' .
					'FROM registrations t0 '.
					'JOIN disciplines t1 ON t1.id = t0.discipline '.
					'JOIN races t2 ON t2.id = t1.race '.
					'WHERE t0.id = ? ' .
					' AND t2.registration_open <= NOW() ' .
					' AND t2.unregistration_close IS NOT NULL ' .
					' AND t2.unregistration_close >= NOW() '.
					'LIMIT 1 '.
					'LOCK IN SHARE MODE');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(1, $this->registrationId, PDO::PARAM_INT);
			} else if (!empty($this->disciplineId)) {
				$sql = sprintf('SELECT 1 ' .
					'FROM disciplines t1 ' .
					'JOIN races t2 ON t2.id = t1.race ' .
					'WHERE t1.id = ? ' .
					' AND t2.registration_open <= NOW() ' .
					' AND t2.unregistration_close IS NOT NULL ' .
					' AND t2.unregistration_close >= NOW() ' .
					'LIMIT 1 ' .
					'LOCK IN SHARE MODE');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(1, $this->disciplineId, PDO::PARAM_INT);
			} else if (!empty($this->raceId)) {
				$sql = sprintf('SELECT 1 ' .
					'FROM races ' .
					'WHERE id = ? ' .
					' AND registration_open <= NOW() ' .
					' AND unregistration_close IS NOT NULL ' .
					' AND unregistration_close >= NOW() ' .
					'LIMIT 1 ' .
					'LOCK IN SHARE MODE');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(1, $this->raceId, PDO::PARAM_INT);
			} else {
				$this->lastError = 'Chybí ID registrace, disciplíny nebo závodu';
				return (false);
			}
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->lastError = 'Odregistrace není možná';
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isUserRegistered()
	{
		try {
			if (!empty($this->registrationId)) {
				$sql = sprintf('SELECT 1 ' .
					'FROM registrations ' .
					'WHERE id = ? AND user = ? ' .
					'LIMIT 1 ' .
					'FOR UPDATE');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(1, $this->registrationId, PDO::PARAM_INT);
			} else {
				if (empty($this->userId)) {
					$this->lastError = 'Chybí ID uživatele';
					return (false);
				}
				if (empty($this->disciplineId)) {
					$this->lastError = 'Chybí ID disciplíny';
					return (false);
				}
				$sql = sprintf('SELECT 1 ' .
					'FROM registrations ' .
					'WHERE discipline = ? AND user = ? ' .
					'LIMIT 1 ' .
					'FOR UPDATE');
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(1, $this->disciplineId, PDO::PARAM_INT);
			}
			$stmt->bindParam(2, $this->userId, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->lastError = 'Uživatel není přihlášen';
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isUserOK()
	{
		global $app_acl;
		try {
			if (empty($this->userId)) {
				$this->lastError = 'Chybí ID uživatele';
				return (false);
			}
			$sql = sprintf('SELECT 1 FROM users WHERE id = ? AND status = 2 AND acl & ' . $app_acl['register'] . ' FOR UPDATE');
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

	public function isLimitOK()
	{
		try {
			if (empty($this->disciplineId)) {
				$this->lastError = 'Chybí ID disciplíny';
				return (false);
			}
			$sql = sprintf('SELECT ((SELECT max_count FROM disciplines WHERE id = ?) - COUNT(id)) AS remaining ' .
				'FROM registrations ' .
				'WHERE discipline = ? ' .
				'FOR UPDATE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->disciplineId, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->disciplineId, PDO::PARAM_INT);
			$stmt->execute();
			$remaining = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt = null;
			if ($remaining <= 0) {
				$this->lastError = 'Dosažen limit počtu registrovaných';
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
			if (empty($this->userId)) {
				$this->lastError = 'Chybí ID uživatele';
				return (false);
			}
			if (empty($this->disciplineId)) {
				$this->lastError = 'Chybí ID disciplíny';
				return (false);
			}
			$sql = sprintf('SELECT 1 ' .
				'FROM disciplines t1, users t2 ' .
				'WHERE t1.id = ? AND t2.id = ? ' .
				' AND (t1.gender IS NULL OR (t1.gender = t2.gender)) ' .
				'LIMIT 1 ' .
				'LOCK IN SHARE MODE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->disciplineId, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->userId, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->lastError = 'Nekompatibilní pohlaví';
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isYearOK()
	{
		try {
			if (empty($this->userId)) {
				$this->lastError = 'Chybí ID uživatele';
				return (false);
			}
			if (empty($this->disciplineId)) {
				$this->lastError = 'Chybí ID disciplíny';
				return (false);
			}
			$sql = sprintf('SELECT 1 ' .
				'FROM disciplines t1, users t2 ' .
				'WHERE t1.id = ? AND t2.id = ? ' .
				' AND t1.year_from >= t2.year AND t2.year >= t1.year_to '.
				'LIMIT 1 ' .
				'LOCK IN SHARE MODE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->disciplineId, PDO::PARAM_INT);
			$stmt->bindParam(2, $this->userId, PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->lastError = 'Nekompatibilní ročník';
				return (false);
			}
			return (true);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function fetchByRace($filter_arr)
	{
		try {
			if (empty($this->raceId)) {
				$this->lastError = 'Chybí ID závodu';
				return (false);
			}
			$discipline = '';
			$search = '';
			if (!empty($filter_arr['discipline']) && isInteger($filter_arr['discipline']))
				$discipline = ' AND t2.id = ? ';
			if (!empty($filter_arr['search']) && strlen($filter_arr['search']) <= 32)
				$search = ' AND (t4.last_name LIKE ? OR t4.first_name LIKE ? OR t4.club LIKE ?) ';
			$sql = sprintf('SELECT ' .
				't1.id AS race_id, t1.name AS race_name, t1.race_date, ' .
				't1.registration_open, t1.registration_close, t1.unregistration_close,' .
				't1.status AS race_status, t1.modified AS race_modified, ' .
				't2.id, t2.name, t2.description, t2.fee, t2.year_from, t2.year_to, ' .
				't2.gender, t2.max_count, t2.start, t2.status, t2.modified, ' .
				'COALESCE(t25.name, "Vše/A") AS gender_name, ' .
				't3.id AS registration_id, t3.note AS registration_note, ' .
				't3.status AS registration_status, t3.created, ' .
				't4.id AS user_id, t4.last_name, t4.first_name, t4.year, t4.club, ' .
				't4.status AS user_status, t4.modified AS user_modified, ' .
				't5.name AS user_gender_name ' .
				'FROM races t1 ' .
				'JOIN disciplines t2 ON t2.race = t1.id ' .
				'LEFT JOIN genders t25 ON t25.id = t2.gender ' .
				'JOIN registrations t3 ON t3.discipline = t2.id ' .
				'JOIN users t4 ON t4.id = t3.user ' .
				'JOIN genders t5 ON t5.id = t4.gender ' .
				'WHERE t1.id = ? ' . $discipline . $search .
				'ORDER BY t3.created DESC ' .
				'LIMIT ' . $this->_config['MAX_REGISTRATIONS_LIST']);
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->raceId, PDO::PARAM_INT);
			if (!empty($discipline))
				$stmt->bindValue(2, $filter_arr['discipline'], PDO::PARAM_INT);
			if (!empty($search)) {
				$stmt->bindValue((!empty($discipline) ? 3 : 2), '%' . $filter_arr['search'] . '%', PDO::PARAM_STR);
				$stmt->bindValue((!empty($discipline) ? 4 : 3), '%' . $filter_arr['search'] . '%', PDO::PARAM_STR);
				$stmt->bindValue((!empty($discipline) ? 5 : 4), '%' . $filter_arr['search'] . '%', PDO::PARAM_STR);
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

	public function fetchByUser()
	{
		try {
			if (empty($this->userId)) {
				$this->lastError = 'Chybí ID uživatele';
				return (false);
			}
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['register'], 0)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['registrations_w'], $this->userId)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			if ($this->showOldRaces)
				$where = '';
			else
				$where = ' AND t1.race_date >= DATE_SUB(NOW(), INTERVAL 3 DAY) ';
			$sql = sprintf('SELECT ' .
				't1.id AS race_id, t1.name AS race_name, t1.race_date, ' .
				't1.registration_open, t1.registration_close, t1.unregistration_close,' .
				't1.status AS race_status, t1.modified AS race_modified, ' .
				't2.id, t2.name, t2.description, t2.fee, t2.year_from, t2.year_to, ' .
				't2.gender, t2.max_count, t2.start, t2.status, t2.modified, ' .
				'COALESCE(t25.name, "Vše/A") AS gender_name, ' .
				't3.id AS registration_id, t3.note AS registration_note, ' .
				't3.status AS registration_status, t3.created, ' .
				't4.id AS user_id, t4.last_name, t4.first_name, t4.year, t4.club, ' .
				't4.status AS user_status, t4.modified AS user_modified, ' .
				't5.name AS user_gender_name ' .
				'FROM users t4 ' .
				'JOIN genders t5 ON t5.id = t4.gender ' .
				'JOIN registrations t3 ON t3.user = t4.id ' .
				'JOIN disciplines t2 ON t2.id = t3.discipline ' .
				'LEFT JOIN genders t25 ON t25.id = t2.gender ' .
				'JOIN races t1 ON t1.id = t2.race ' .
				'WHERE t4.id = ? ' . $where .
				'ORDER BY t1.race_date ASC');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
			$stmt->execute();
			$registrations_arr = $stmt->fetchAll();
			$stmt = null;
			return ($registrations_arr);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function getLastError()
	{
		return ($this->lastError);
	}
}
?>