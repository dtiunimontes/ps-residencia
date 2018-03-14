<?php

namespace App\Repositories;

use App\Models\Residencia;

class ResidenciasRepository
{
    public static function getAll()
    {
        return Residencia::get();
    }
}