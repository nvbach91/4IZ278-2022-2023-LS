<?php

namespace Repositories;

require_once __DIR__ . '/../lib/database.php';

use Lib;

class CategoryRepository extends Lib\Database
{
    public function __construct()
    {
        parent::__construct('categories');
    }
}