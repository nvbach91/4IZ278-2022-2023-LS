<?php

require_once __DIR__ . '/AbstractClasses/AbstractDatabase.php';

class CategoriesDB extends Database
{
    protected $db_table = 'categories';
    protected $db_table_pk = 'category_id';

    public function create($args) {}
    public function save() {}
    public function delete() {}
}