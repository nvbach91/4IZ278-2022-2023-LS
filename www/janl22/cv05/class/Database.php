<?php

namespace classes;

require_once __DIR__ . '/../interface/DatabaseOperations.php';

use DatabaseOperations;

abstract class Database implements DatabaseOperations {

	protected string $dbPath = './database/';
	protected string $dbExtension = '.db';
	protected string $dbDelimiter = ';';

	public function __construct() {

		return '---------- ' . static::class . ' was instanced ----------' . PHP_EOL;

	}

	public function __toString() {

		return 'Database configuration: DB Name: ' . $this->dbName . ' | DB Path: ' . $this->dbPath . ' | DB Extension: ' . $this->dbExtension . ' | DB Delimiter: ' . $this->dbDelimiter . PHP_EOL;

	}

	public function getConfig() {

		return $this;

	}

}