<?php
// crossmile @ LXSX file:www-html/classes/Races.php

class Races
{
	public $loggedUserId;
	public $raceId;
	public $raceToSanitize_arr;
	public $raceSanitized_arr;
	public $userId;
	public $showOldRaces;

	protected $lastError;

	private $_config;
	private $_db;
	private $_app_acl;

	public function __construct($config, PDO $db, $app_acl) 
	{
		$this->_config = $config;
		$this->_db = $db;
		$this->_app_acl = $app_acl;

		$this->loggedUserId = 0;
		$this->userId = 0;
		$this->showOldRaces = 0;
		$this->lastError = '';
	}

	public function fetchAll()
	{
		try {
			if ($this->showOldRaces)
				$where = '';
			else
				$where = ' AND t1.race_date >= DATE_SUB(NOW(), INTERVAL 3 DAY) ';
			$sql = sprintf('SELECT ' .
				't1.id AS race_id, t1.name AS race_name, t1.race_date, t1.registration_open, ' .
				't1.registration_close, t1.unregistration_close, t1.status AS race_status, t1.modified AS race_modified, ' .
				'MIN(t2.fee) AS min_fee, MAX(t2.fee) AS max_fee, ' .
				'COUNT(t3.id) AS registered_count ' .
				'FROM races t1 ' .
				'JOIN disciplines t2 ON t2.race = t1.id ' .
				'LEFT JOIN registrations t3 ON t3.discipline = t2.id ' .
				'WHERE t1.status = 1 ' . $where .
				'GROUP BY t1.id ' .
				'ORDER BY t1.race_date ASC');
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			$races_arr = $stmt->fetchAll();
			$stmt = null;
			return ($races_arr);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function fetchRaceDisciplines()
	{
		try {
			if (empty($this->raceId)) {
				$this->lastError = 'Chybí ID závodu';
				return (false);
			}
			$sql = sprintf('SELECT ' .
				't1.id AS race_id, t1.name AS race_name, t1.race_date, ' .
				't1.registration_open, t1.registration_close, t1.unregistration_close, t1.modified AS race_modified, ' .
				't2.id, t2.name, t2.description, t2.fee, t2.year_from, t2.year_to, t2.gender, ' .
				't2.max_count, t2.start, t2.status, t2.modified, ' .
				'COALESCE(t25.name, "Vše/A") AS gender_name, ' .
				'COUNT(t3.id) AS registered_count, ' .
				'COALESCE(t4.id, 0) AS registration_id, t4.user AS user_id, COALESCE(t4.id, 0) AS user_registered ' .
				'FROM races t1 ' .
				'JOIN disciplines t2 ON t2.race = t1.id ' .
				'LEFT JOIN genders t25 ON t25.id = t2.gender ' .
				'LEFT JOIN registrations t3 ON t3.discipline = t2.id ' .
				'LEFT JOIN registrations t4 ON t4.discipline = t2.id AND t4.user = ? ' .
				'WHERE t1.id = ? ' .
				'GROUP BY t2.id ' .
				'ORDER BY t2.start ASC, t2.gender DESC');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindValue(1, $this->userId);
			$stmt->bindParam(2, $this->raceId);
			$stmt->execute();
			$disciplines_arr = $stmt->fetchAll();
			$stmt = null;
			return ($disciplines_arr);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	public function isRaceRegisterable($race_arr)
	{
		$now = date('Y-m-d H:i:s');
		if (!empty($_SESSION['user_is_logged_in'])
			&& $race_arr['race_status'] == 1
			&& $race_arr['registration_open'] <= $now
			&& $race_arr['registration_close'] > $now)
			return (true);
		else
			return (false);
	}

	public function duplicateRace()
	{
		try {
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['races_w'], 0)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			if (empty($this->raceSanitized_arr)) {
				$this->lastError = 'Prázdné pole pro vložení';
				return (false);
			}
			$this->_db->beginTransaction();
			$sql = sprintf('INSERT INTO races ' .
				'(name, race_date, status, registration_open, registration_close, unregistration_close) ' .
				'SELECT ?, ?, status, ' .
				'DATE_ADD(registration_open, INTERVAL DATEDIFF(?, race_date) DAY), ' .
				'DATE_ADD(registration_close, INTERVAL DATEDIFF(?, race_date) DAY), ' .
				'IF(unregistration_close IS NOT NULL, DATE_ADD(unregistration_close, INTERVAL DATEDIFF(?, race_date) DAY), NULL) ' .
				'FROM races ' .
				'WHERE id = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindValue(1, $this->raceSanitized_arr['race_name']);
			$stmt->bindValue(2, $this->raceSanitized_arr['race_date']);
			$stmt->bindValue(3, $this->raceSanitized_arr['race_date']);
			$stmt->bindValue(4, $this->raceSanitized_arr['race_date']);
			$stmt->bindValue(5, $this->raceSanitized_arr['race_date']);
			$stmt->bindValue(6, $this->raceSanitized_arr['race_id']);
			$stmt->execute();
			$count = $stmt->rowCount();
			$raceId = $this->_db->lastInsertId();
			$stmt = null;
			if (empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Závod se nepodařilo duplikovat, zkuste to za chvíli znovu';
				return (false);
			}
			$sql = sprintf('SET @TRIGGER_CHECKS = FALSE');
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			$stmt = null;
			$sql = sprintf('INSERT INTO disciplines ' .
				'(race, name, description, fee, year_from, year_to, start, gender, max_count, status) ' .
				'SELECT ?, t1.name, t1.description, t1.fee, ' .
				't1.year_from + YEAR(?) - YEAR(t2.race_date), ' .
				't1.year_to + YEAR(?) - YEAR(t2.race_date), ' .
				'DATE_ADD(t1.start, INTERVAL DATEDIFF(?, t2.race_date) DAY), ' .
				't1.gender, t1.max_count, t1.status ' .
				'FROM disciplines t1 ' .
				'JOIN races t2 ON t2.id = t1.race ' .
				'WHERE t1.race = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindValue(1, $raceId);
			$stmt->bindValue(2, $this->raceSanitized_arr['race_date']);
			$stmt->bindValue(3, $this->raceSanitized_arr['race_date']);
			$stmt->bindValue(4, $this->raceSanitized_arr['race_date']);
			$stmt->bindValue(5, $this->raceSanitized_arr['race_id']);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			$sql = sprintf('SET @TRIGGER_CHECKS = TRUE');
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			$stmt = null;
			if (empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Disciplíny se nepodařilo duplikovat, zkuste to za chvíli znovu';
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

	public function deleteRace()
	{
		try {
			// ACL check
			if (!AuthService::aclCheckCross($this->loggedUserId, $this->_app_acl['races_w'], 0)) {
				$this->lastError = 'Nedostatečná oprávnění';
				return (false);
			}
			if (empty($this->raceSanitized_arr)) {
				$this->lastError = 'Prázdné pole pro smazání';
				return (false);
			}
			$this->_db->beginTransaction();
			$sql = sprintf('SELECT 1 ' .
				'FROM races t1 ' .
				'JOIN disciplines t2 ON t2.race = t1.id ' .
				'JOIN registrations t3 ON t3.discipline = t2.id ' .
				'WHERE t1.id = ? ' .
				'FOR UPDATE');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindValue(1, $this->raceSanitized_arr['race_id']);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (!empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Na závod jsou přihlášení účastníci. Nejdříve je odhlašte.';
				return (false);
			}
			$sql = sprintf('DELETE FROM races WHERE id = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindValue(1, $this->raceSanitized_arr['race_id']);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (empty($count)) {
				$this->_db->rollBack();
				$this->lastError = 'Závod se nepodařilo smazat, zkuste to za chvíli znovu';
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

	public function satinizeRaceData()
	{
		if (empty($this->raceToSanitize_arr)) {
			$this->lastError = 'Prázdné pole pro sanitizaci';
			return (false);
		}
		$this->raceSanitized_arr['race_id'] = (isset($this->raceToSanitize_arr['race_id']) ? filter_var(trim($this->raceToSanitize_arr['race_id']), FILTER_SANITIZE_NUMBER_INT) : '');
		$this->raceSanitized_arr['race_name'] = (isset($this->raceToSanitize_arr['race_name']) ? htmlspecialchars(trim($this->raceToSanitize_arr['race_name']), ENT_QUOTES) : '');
		$this->raceSanitized_arr['race_date'] = (isset($this->raceToSanitize_arr['race_date']) ? htmlspecialchars(trim($this->raceToSanitize_arr['race_date']), ENT_QUOTES) : '');
		$this->raceSanitized_arr['form_type'] = (isset($this->raceToSanitize_arr['form_type']) ? htmlspecialchars(trim($this->raceToSanitize_arr['form_type']), ENT_QUOTES) : '');
		return (true);
	}

	public function validateRaceData($type)
	{
		if (empty($this->raceSanitized_arr)) {
			$this->lastError = 'Prázdné pole pro validaci';
			return (false);
		}
		// race id
		if (!filter_var($this->raceSanitized_arr['race_id'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0))))
			$errors_arr['race_id'] = 'Neplatné Race ID';
		// form type
		if (empty($this->raceSanitized_arr['form_type']) || !preg_match('/^(duplicate|delete)$/', $this->raceSanitized_arr['form_type']))
			$errors_arr['form_type'] = 'Neplatný typ formuláře';
		// race name
		if ($type == 'duplicate' && (empty($this->raceSanitized_arr['race_name']) || strlen($this->raceSanitized_arr['race_name']) < 3 || strlen($this->raceSanitized_arr['race_name']) > 128))
			$errors_arr['race_name'] = 'Zadejte prosím platné jméno závodu';
		// race date
		if ($type == 'duplicate' && (empty($this->raceSanitized_arr['race_date']) || validateDateTime($this->raceSanitized_arr['race_date'], 'd.m.Y')))
			$errors_arr['birthday'] = 'Vyberte prosím platné datum závodu';
		if (empty($errors_arr)) {
			return (true);
		} else {
			$this->lastError = $errors_arr;
			return (false);
		}
	}

	public function getLastError()
	{
		return ($this->lastError);
	}
}
?>