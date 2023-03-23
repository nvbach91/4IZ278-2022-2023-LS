<?php

interface DatabaseOperations {
	public function create($args);
	public function fetch($id);
	public function save($id, $args);
	public function delete($id);
}