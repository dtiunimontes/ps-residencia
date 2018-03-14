<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ResidenciasController extends Controller{

    public function getInfoResidencias(Request $request){
	    if(!empty($request->codigo)){
		
		    $curso = DB::table('residencias')
			    ->join('programas', 'programas.id', '=', 'residencias.programa_id')
			    ->join('categorias_profissionais', 'categorias_profissionais.id', '=', 'residencias.categoria_profissional_id')
			    ->join('cidades_polos', 'cidades_polos.id', '=', 'residencias.cidade_polo_id')
			    ->where('residencias.id', '=', $request->codigo)
			    ->select(
				    'programas.nome as nome_programa',
				    'categorias_profissionais.nome as categoria_profissional_nome',
				    'cidades_polos.nome as cidade_polo_nome'
			    )
			    ->get()->first();
		
		    if(!empty($curso)){
			    echo $curso->nome_programa .' - '. $curso->categoria_profissional_nome .' - '. $curso->cidade_polo_nome;
		    }else{
			    echo 'erro';
		    }
	    }else{
		    echo 'erro';
	    }
    }
}
