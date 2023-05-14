<?php

namespace App\Models;

use Nette\Database\Explorer;
use Nette\Database\Table\Selection;

class UserFactory
{
    public function __construct(private Explorer $database)
    {
        $this->database = $database;
    }

    public function getTable(): Selection
    {
        return $this->database->table('user');
    }
}