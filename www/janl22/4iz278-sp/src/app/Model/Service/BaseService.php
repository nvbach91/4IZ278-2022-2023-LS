<?php

declare(strict_types=1);

namespace App\Model\Service;

use Nette;

/**
 * Database service
 *
 * Service providing access to database.
 */
class BaseService {

	public Nette\Database\Connection $databaseC;
	public Nette\Database\Explorer $databaseE;
	public Nette\Security\Passwords $passwords;

	public function __construct(Nette\Database\Connection $databaseC, Nette\Database\Explorer $databaseE, Nette\Security\Passwords $passwords) {

		$this->databaseC = $databaseC;
		$this->databaseE = $databaseE;
		$this->passwords = $passwords;

	}

}