<?php
// crossmile @ LXSX file:www-html/classes/Emails.php

require_once(__DIR__ . '/Format.php');
require_once(__DIR__ . '/../../libs/send-emails.php');

class Emails
{
	public $userId;
	public $disciplineId;
	public $registrationId;

	public $emailFrom;
	protected $emailBcc;

	protected $user_arr;
	protected $discipline_arr;
	protected $lastError;

	private $_config;
	private $_db;

	public function __construct($config, PDO $db) 
	{
		$this->_config = $config;
		$this->_db = $db;

		$this->lastError = '';

		$this->emailFrom = $this->_config['EMAIL_FROM'];
		//$this->emailBcc = [$this->_config['EMAIL_ADMIN']]; //TBD
		$this->emailBcc = ['martin@skmile.cz'];
	}

	public function emailUserConfirm()
	{
		if (($this->user_arr = $this->_getUser()) === false)
			return (false);
		if (empty($this->user_arr['hash'])) {
			$this->lastError = 'Chybí Hash uživatele';
			return (false);
		}
		$this->subject = 'Krosová míle :: potvrzovací odkaz pro nového uživatele';
		$this->body = 'Dobrý den, ' . Format::toFullName($this->user_arr['first_name'], $this->user_arr['last_name']) . '!' . "\r\n" .
			"\r\n" .
			'Pro potvrzení svého uživatelského účtu klikněte prosím ' .
			'na následující odkaz platný 3 hodiny:' . "\r\n" .
			'https://' . $this->_config['DOMAIN'] . '/confirmation-' . $this->user_arr['hash'] . "\r\n" .
			"\r\n" .
			'Děkujeme a těšíme se na Vás!' . "\r\n" .
			"\r\n" .
			'Registrační automat Krosové míle' . "\r\n" .
			"\r\n" .
			'-----------------------------' . "\r\n" .
			'Pokud jste si účet v Krosové míle nevytvářeli,' . "\r\n" .
			'ignorujte prosím tento e-mail. Děkujeme!' . "\r\n" .
			'Na tento e-mail neodpovídejte,' . "\r\n" .
			'adresa ' . $this->emailFrom . ' žádné zprávy nepřijímá.';
		return (sendEmails($this->emailFrom, (array)$this->user_arr['email'], '', $this->emailBcc, $this->subject, $this->body, 'text'));
	}

	public function emailUserReady()
	{
		if (($this->user_arr = $this->_getUser()) === false)
			return (false);
		$this->subject = 'Krosová míle :: přístupové údaje k novému účtu';
		$this->body = 'Dobrý den, ' . Format::toFullName($this->user_arr['first_name'], $this->user_arr['last_name']) . '!' . "\r\n" .
			"\r\n" .
			'Váš účet byl úspěšně potvrzen a aktivován.' . "\r\n" .
			'Nyní se do něj můžete přihlásit:' . "\r\n" .
			"\r\n" .
			'https://' . $this->_config['DOMAIN'] . "\r\n" .
			'jméno: ' . $this->user_arr['email']. "\r\n" .
			'heslo: ' . $this->user_arr['password'] . "\r\n" .
			"\r\n" .
			'Tam prosím pečlivě zkontrolujte všechny údaje.' . "\r\n" .
			'Následně se můžete registrovat na první závod.' . "\r\n" .
			"\r\n" .
			'Děkujeme a těšíme se na Vás!' . "\r\n" .
			"\r\n" .
			'Registrační automat Krosové míle' . "\r\n" .
			"\r\n" .
			'-----------------------------' . "\r\n" .
			'Na tento e-mail neodpovídejte,' . "\r\n" .
			'adresa ' . $this->emailFrom . ' žádné zprávy nepřijímá.';
		return (sendEmails($this->emailFrom, (array)$this->user_arr['email'], '', $this->emailBcc, $this->subject, $this->body, 'text'));
	}

	public function emailUserRegistered()
	{
		if (($this->user_arr = $this->_getUser()) === false)
			return (false);
		if (($this->discipline_arr = $this->_getDiscipline()) === false)
			return (false);
		$this->subject = 'Krosová míle :: registrace na závod ' . $this->discipline_arr['race_name'] . ' ' . Format::toDate('d. m. Y', $this->discipline_arr['race_date']);
		$this->body = 'Dobrý den, ' . Format::toFullName($this->user_arr['first_name'], $this->user_arr['last_name']) . '!' . "\r\n" .
			"\r\n" .
			'Úspěšně jste se zaregistroval' . ($this->discipline_arr['gender'] == 1 ? 'a' : '') . ' na závod ' . $this->discipline_arr['race_name'] . ':' . "\r\n" .
			'Start: ' . Format::toDate('d.m.Y H:i', $this->discipline_arr['start']) . "\r\n" .
			'Detaily: ' . Format::toFullDiscipline($this->discipline_arr) . "\r\n" .
			'Startovné: ' . $this->discipline_arr['fee'] . ' Kč' . "\r\n" .
			'URL: https://' . $this->_config['DOMAIN'] . "\r\n" .
			"\r\n" .
			'Děkujeme a těšíme se na Vás!' . "\r\n" .
			"\r\n" .
			'Registrační automat Krosové míle' . "\r\n" .
			"\r\n" .
			'-----------------------------' . "\r\n" .
			'Na tento e-mail neodpovídejte,' . "\r\n" .
			'adresa ' . $this->emailFrom . ' žádné zprávy nepřijímá.';
		return (sendEmails($this->emailFrom, (array)$this->user_arr['email'], '', $this->emailBcc, $this->subject, $this->body, 'text'));
	}

	public function emailUserUnregistered()
	{
		if (($this->user_arr = $this->_getUser()) === false)
			return (false);
		if (($this->discipline_arr = $this->_getDiscipline()) === false)
			return (false);
		$this->subject = 'Krosová míle :: odregistrace ze závodu ' . $this->discipline_arr['race_name'] . ' ' . Format::toDate('d. m. Y', $this->discipline_arr['race_date']);
		$this->body = 'Dobrý den, ' . Format::toFullName($this->user_arr['first_name'], $this->user_arr['last_name']) . '!' . "\r\n" .
			"\r\n" .
			'Úspěšně jste se odregistroval' . ($this->discipline_arr['gender'] == 1 ? 'a' : '') . ' ze závodu ' . $this->discipline_arr['race_name'] . ':' . "\r\n" .
			'Start: ' .Format::toDate('d.m.Y H:i', $this->discipline_arr['start']) . "\r\n" .
			'Detaily: ' . Format::toFullDiscipline($this->discipline_arr) . "\r\n" .
			'Startovné: ' . $this->discipline_arr['fee'] . ' Kč' . "\r\n" .
			'URL: https://' . $this->_config['DOMAIN'] . "\r\n" .
			"\r\n" .
			'Těšíme se na Vás příště!' . "\r\n" .
			"\r\n" .
			'Registrační automat Krosové míle' . "\r\n" .
			"\r\n" .
			'-----------------------------' . "\r\n" .
			'Na tento e-mail neodpovídejte,' . "\r\n" .
			'adresa ' . $this->emailFrom . ' žádné zprávy nepřijímá.';
		return (sendEmails($this->emailFrom, (array)$this->user_arr['email'], '', $this->emailBcc, $this->subject, $this->body, 'text'));
	}

	public function getLastError()
	{
		return ($this->lastError);
	}

	private function _getUser()
	{
		try {
			if (empty($this->userId)) {
				$this->lastError = 'Chybí ID uživatele';
				return (false);
			}
			$sql = sprintf('SELECT ' .
				't1.id, t1.email, t1.password, t1.last_name, t1.first_name, t1.acl, ' .
				'COALESCE(t2.hash, "") AS hash ' .
				'FROM users t1 ' .
				'LEFT JOIN users_confirmation_hashes t2 ON t2.user = t1.id ' .
				'WHERE t1.id = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->userId, PDO::PARAM_INT);
			$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt = null;
			if (empty($user)) {
				$this->lastError = 'Uživatel nenalezen';
				return (false);
			}
			return ($user);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	private function _getDiscipline()
	{
		try {
			if (empty($this->disciplineId)) {
				$this->lastError = 'Chybí ID disciplíny';
				return (false);
			}
			$sql = sprintf('SELECT ' .
				't1.id, t1.name, t1.description, t1.fee, t1.gender, t1.start, ' .
				't2.id AS race_id, t2.race_date AS race_date, t2.name AS race_name, ' .
				'COALESCE(t25.name, "Vše/A") AS gender_name ' .
				'FROM disciplines t1 ' .
				'JOIN races t2 ON t2.id = t1.race ' .
				'LEFT JOIN genders t25 ON t25.id = t1.gender ' .
				'WHERE t1.id = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->disciplineId, PDO::PARAM_INT);
			$stmt->execute();
			$discipline = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt = null;
			if (empty($discipline)) {
				$this->lastError = 'Disciplína nenalezena';
				return (false);
			}
			return ($discipline);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}

	private function _getRegistration()
	{
		try {
			if (empty($this->registrationId)) {
				$this->lastError = 'Chybí ID registrace';
				return (false);
			}
			$sql = sprintf('SELECT discipline, user FROM registrations WHERE id = ?');
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(1, $this->registrationId, PDO::PARAM_INT);
			$stmt->execute();
			$registration = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt = null;
			if (empty($registration)) {
				$this->lastError = 'Registrace nenalezena';
				return (false);
			}
			return ($registration);
		} catch (PDOException $e) {
			print 'DB query failed: ' . $e->getMessage() . "<br>\n";
			die();
		}
	}
}
?>