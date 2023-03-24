<?php
// file:cv05/libs/classes.php

require_once(__DIR__ . '/utils.php');

interface DatabaseOperations
{
	public function fetch($name);
	public function create($args);
	public function save($args);
	public function delete($name);
}

abstract class Database implements DatabaseOperations
{
	protected $dbPath = 'database/'; 
	protected $dbExtension = '.db';
	protected $delimiter = ';';
	public function __construct()
	{
		print 'Class ' . static::class . ' instantiated' . PHP_EOL;
	}
	public function __toString()
	{
		return ('Database config: dbPath: ' . $this->dbPath . ', dbExtension: ' . $this->dbExtension . ', delimiter: ' . $this->delimiter);
	}
	public function configInfo()
	{
		print $this . PHP_EOL;
	}
}

class UsersDB extends Database
{
	protected $dbFile = 'users';
	protected $dbHeader = ['name', 'age'];
	protected $fileName = '';
	public function __construct()
	{
		$this->fileName = $this->dbPath . $this->dbFile . $this->dbExtension;
		if (!file_exists($this->fileName))
			create_write_csv($this->dbHeader, [], $this->fileName, $this->delimiter);
	}
	public function fetchAll()
	{
		return (read_parse_csv($this->fileName, $this->delimiter));
	}
	public function create($args)
	{
		if (array_search($args['name'], array_column($this->fetchAll(), 'name')) !== false)
			print 'Error: user "' . $args['name'] . '" exists' . PHP_EOL;
		else {
			if (!create_append_csv($args, $this->fileName, $this->delimiter))
				print 'Error: cannot write to DB' . PHP_EOL;
			else
				print 'User "' . $args['name'] . '", age ' . $args['age'] . ' created' . PHP_EOL;
		}
	}
	public function fetch($name)
	{
		$res = array_values(array_filter($this->fetchAll(), fn($arr) => $arr['name'] == $name));
		print 'User "' . $name . '" fetch result: ' . (!empty($res[0]['name']) ? $res[0]['name'] . ', ' . $res[0]['age'] : 'not found') . PHP_EOL;
		return (!empty($res[0]) ? $res[0] : null);
	}
	public function save($args)
	{
		$all_arr = $this->fetchAll();
		if (array_search($args['name'], array_column($all_arr, 'name')) === false)
			print 'Error: user "' . $args['name'] . '" not exists' . PHP_EOL;
		else {
			$all_arr = array_filter($all_arr, fn($arr) => $arr['name'] != $args['name']);
			array_push($all_arr, $args);
			if (!create_write_csv($this->dbHeader, $all_arr, $this->fileName, $this->delimiter))
				print 'Error: cannot write to DB' . PHP_EOL;
			else
				print 'User saved: ' . $args['name'] . ', ' . $args['age'] . PHP_EOL;
		}
	}
	public function delete($name)
	{
		$all_arr = $this->fetchAll();
		if (array_search($name, array_column($all_arr, 'name')) === false)
			print 'Error: user "' . $name . '" not exists' . PHP_EOL;
		else {
			$all_arr = array_filter($all_arr, fn($arr) => $arr['name'] != $name);
			if (!create_write_csv($this->dbHeader, $all_arr, $this->fileName, $this->delimiter))
				print 'Error: cannot write to DB' . PHP_EOL;
			else
				print 'User "' . $name . '" deleted' . PHP_EOL;
		}
	}
}

class ProductsDB extends Database
{
	protected $dbFile = 'products';
	protected $dbHeader = ['name', 'price'];
	protected $fileName = '';
	public function __construct()
	{
		$this->fileName = $this->dbPath . $this->dbFile . $this->dbExtension;
		if (!file_exists($this->fileName))
			create_write_csv($this->dbHeader, [], $this->fileName, $this->delimiter);
	}
	public function fetchAll()
	{
		return (read_parse_csv($this->fileName, $this->delimiter));
	}
	public function create($args)
	{
		if (array_search($args['name'], array_column($this->fetchAll(), 'name')) !== false)
			print 'Error: product "' . $args['name'] . '" exists' . PHP_EOL;
		else {
			if (!create_append_csv($args, $this->fileName, $this->delimiter))
				print 'Error: cannot write to DB' . PHP_EOL;
			else
				print 'Product "' . $args['name'] . '", price ' . $args['price'] . ' created' . PHP_EOL;
		}
	}
	public function fetch($name)
	{
		$res = array_values(array_filter($this->fetchAll(), fn($arr) => $arr['name'] == $name));
		print 'Product "' . $name . '" fetch result: ' . (!empty($res[0]['name']) ? $res[0]['name'] . ', ' . $res[0]['price'] : 'not found') . PHP_EOL;
		return (!empty($res[0]) ? $res[0] : null);
	}
	public function save($args)
	{
		$all_arr = $this->fetchAll();
		if (array_search($args['name'], array_column($all_arr, 'name')) === false)
			print 'Error: product "' . $args['name'] . '" not exists' . PHP_EOL;
		else {
			$all_arr = array_filter($all_arr, fn($arr) => $arr['name'] != $args['name']);
			array_push($all_arr, $args);
			if (!create_write_csv($this->dbHeader, $all_arr, $this->fileName, $this->delimiter))
				print 'Error: cannot write to DB' . PHP_EOL;
			else
				print 'Product saved: ' . $args['name'] . ', ' . $args['price'] . PHP_EOL;
		}
	}
	public function delete($name)
	{
		$all_arr = $this->fetchAll();
		if (array_search($name, array_column($all_arr, 'name')) === false)
			print 'Error: product "' . $name . '" not exists' . PHP_EOL;
		else {
			$all_arr = array_filter($all_arr, fn($arr) => $arr['name'] != $name);
			if (!create_write_csv($this->dbHeader, $all_arr, $this->fileName, $this->delimiter))
				print 'Error: cannot write to DB' . PHP_EOL;
			else
				print 'Product "' . $name . '" deleted' . PHP_EOL;
		}
	}
}

class OrdersDB extends Database
{
	protected $dbFile = 'orders';
	protected $dbHeader = ['number', 'date'];
	protected $fileName = '';
	public function __construct()
	{
		$this->fileName = $this->dbPath . $this->dbFile . $this->dbExtension;
		if (!file_exists($this->fileName))
			create_write_csv($this->dbHeader, [], $this->fileName, $this->delimiter);
	}
	public function fetchAll()
	{
		return (read_parse_csv($this->fileName, $this->delimiter));
	}
	public function create($args)
	{
		$args['date'] = date('Y-m-d', strtotime($args['date']));
		if (array_search($args['number'], array_column($this->fetchAll(), 'number')) !== false)
			print 'Error: Order no "' . $args['number'] . '" exists' . PHP_EOL;
		else {
			if (!create_append_csv($args, $this->fileName, $this->delimiter))
				print 'Error: cannot write to DB' . PHP_EOL;
			else
				print 'Order no "' . $args['number'] . '", date ' . $args['date'] . ' created' . PHP_EOL;
		}
	}
	public function fetch($number)
	{
		$res = array_values(array_filter($this->fetchAll(), fn($arr) => $arr['number'] == $number));
		print 'Order no "' . $number . '" fetch result: ' . (!empty($res[0]['number']) ? $res[0]['number'] . ', ' . $res[0]['date'] : 'not found') . PHP_EOL;
		return (!empty($res[0]) ? $res[0] : null);
	}
	public function save($args)
	{
		$all_arr = $this->fetchAll();
		if (array_search($args['number'], array_column($all_arr, 'number')) === false)
			print 'Error: Order no "' . $args['number'] . '" not exists' . PHP_EOL;
		else {
			$args['date'] = date('Y-m-d', strtotime($args['date']));
			$all_arr = array_filter($all_arr, fn($arr) => $arr['number'] != $args['number']);
			array_push($all_arr, $args);
			if (!create_write_csv($this->dbHeader, $all_arr, $this->fileName, $this->delimiter))
				print 'Error: cannot write to DB' . PHP_EOL;
			else
				print 'Order saved: ' . $args['number'] . ', ' . $args['date'] . PHP_EOL;
		}
	}
	public function delete($number)
	{
		$all_arr = $this->fetchAll();
		if (array_search($number, array_column($all_arr, 'number')) === false)
			print 'Error: Order no "' . $number . '" not exists' . PHP_EOL;
		else {
			$all_arr = array_filter($all_arr, fn($arr) => $arr['number'] != $number);
			if (!create_write_csv($this->dbHeader, $all_arr, $this->fileName, $this->delimiter))
				print 'Error: cannot write to DB' . PHP_EOL;
			else
				print 'Order no "' . $number . '" deleted' . PHP_EOL;
		}
	}
}
?>