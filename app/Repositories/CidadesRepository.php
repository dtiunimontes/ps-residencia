<?php

namespace App\Repositories;

use App\Models\Cidades;

class CidadesRepository
{
    public static function getAll()
    {
        return Cidades::get();
    }
}