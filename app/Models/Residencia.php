<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residencia extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cidadePolo()
    {
        return $this->belongsTo(CidadePolo::class, 'cidade_polo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoriaProfissional()
    {
        return $this->belongsTo(CategoriaProfissional::class, 'categoria_profissional_id');
    }
}
