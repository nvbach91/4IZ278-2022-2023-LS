<?php

require_once __DIR__ . '/AbstractClasses/AbstractDatabase.php';

class SlidesDB extends Database
{
    protected $db_table = 'slides';
    protected $db_table_pk = 'slide_id';

    public function create($args) {}
    public function save() {}
    public function delete() {}
}