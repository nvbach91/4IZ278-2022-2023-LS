<?php

namespace App\Services;

use App\Models\Property;

class PropertyService
{
    public function getNumberOfProperties(int $type, int $status = null): int
    {
        $query = Property::query()->where('property_type', $type);

        if ($status !== null) {
            $query->where('rentsale', $status);
        }

        return $query->count();
    }
}