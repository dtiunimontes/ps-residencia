<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessoSeletivo extends Model{

    protected $fillable = ['nome', 'descricao', 'atual'];
    protected $hidden = [];


}
