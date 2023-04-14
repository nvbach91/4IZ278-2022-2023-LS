<?php

namespace Repositories;

require_once __DIR__ . '/../lib/database.php';

use Lib;

class ProductRepository extends Lib\Database
{
    public function __construct()
    {
        parent::__construct('products');
    }

    public function fetchByCategoryId($category_id): false|array
    {
        return $this->fetchRaw('SELECT * FROM ' . $this->tableName . ' WHERE category_id = :category_id;', [':category_id' => $category_id]);
    }
}