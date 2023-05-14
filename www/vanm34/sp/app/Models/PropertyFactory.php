<?php

namespace App\Models;

use Nette\Database\Explorer;
use Nette\Database\Table\Selection;

class PropertyFactory
{


    public function __construct(private Explorer $database)
    {
        $this->database = $database;
    }

    public function getTable(): Selection
    {
        return $this->database->table('property');
    }

    public function getNumberOfProperties(int $type, int $status = null): int
    {
        $query = $this->getTable()
            ->where('property_type', $type);

        if ($status !== null) {
            $query->where('rentsale', $status);
        }

        return $query->count();
    }
}