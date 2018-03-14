<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{

    public function run(){

        DB::table('configs')->insert([
            'termino_inscricoes' => '2018-01-15 18:00:00',
            'termino_pedido_isencao' => '2017-12-29 18:00:00',
            'termino_pagamento_dae' => '2018-01-15 23:59:59',
            'dia_limite_pag_dae_indeferidos' => '2018-01-22 23:59:59',
        ]);

        DB::table('usuarios')->insert([
            'nome' => 'Fellipe Geraldo Pereira Botelho',
            'email' => 'fellipe.botelho@unimontes.br',
            'cpf' => '11122233344',
            'password' => bcrypt('5557975'),
            'permissao' => 2
        ]);

        DB::table('programas')->insert([
        	'nome' => 'Residência de Enfermagem em Obstetrícia',
        ]);
        
        DB::table('programas')->insert([
        	'nome' => 'Residência Multiprofissional em Saúde da Família',
        ]);
        
        DB::table('programas')->insert([
        	'nome' => 'Residência Multiprofissional em Saúde da Família e Comunidade',
        ]);
        
        DB::table('programas')->insert([
        	'nome' => 'Residência Multiprofissional em Saúde Mental',
        ]);
        
        DB::table('programas')->insert([
        	'nome' => 'Residência de Enfermagem em Saúde da Mulher, com ênfase em Saúde da Família',
        ]);
        
        DB::table('categorias_profissionais')->insert([
        	'nome' => 'Enfermagem',
        ]);
        
        DB::table('categorias_profissionais')->insert([
        	'nome' => 'Odontologia',
        ]);
        
        DB::table('categorias_profissionais')->insert([
        	'nome' => 'Psicologia',
        ]);
        
        DB::table('categorias_profissionais')->insert([
        	'nome' => 'Farmácia',
        ]);
        
        DB::table('categorias_profissionais')->insert([
        	'nome' => 'Serviço Social',
        ]);
        
        DB::table('cidades_polos')->insert([
        	'nome' => 'Montes Claros',
        ]);
        
        DB::table('cidades_polos')->insert([
        	'nome' => 'Taioberas',
        ]);
        
        DB::table('cidades_polos')->insert([
        	'nome' => 'Pirapora',
        ]);
        
        DB::table('residencias')->insert([
        	'id' => 1,
        	'vagas' => 4,
	        'cidade_polo_id' => 1,
	        'categoria_profissional_id' => 1,
	        'programa_id' => 1
        ]);
	
	    DB::table('residencias')->insert([
             'id' => 2,
             'vagas' => 12,
             'cidade_polo_id' => 1,
             'categoria_profissional_id' => 1,
             'programa_id' => 2
        ]);
	    
	    DB::table('residencias')->insert([
             'id' => 3,
             'vagas' => 12,
             'cidade_polo_id' => 1,
             'categoria_profissional_id' => 2,
             'programa_id' => 2
        ]);
	    
	    DB::table('residencias')->insert([
             'id' => 4,
             'vagas' => 4,
             'cidade_polo_id' => 1,
             'categoria_profissional_id' => 3,
             'programa_id' => 2
        ]);
	    
	    DB::table('residencias')->insert([
             'id' => 5,
             'vagas' => 3,
             'cidade_polo_id' => 2,
             'categoria_profissional_id' => 1,
             'programa_id' => 3
        ]);
	    
	    DB::table('residencias')->insert([
             'id' => 6,
             'vagas' => 3,
             'cidade_polo_id' => 2,
             'categoria_profissional_id' => 4,
             'programa_id' => 3
        ]);
	    
	    DB::table('residencias')->insert([
             'id' => 7,
             'vagas' => 3,
             'cidade_polo_id' => 2,
             'categoria_profissional_id' => 2,
             'programa_id' => 3
        ]);
	    
	    DB::table('residencias')->insert([
             'id' => 8,
             'vagas' => 2,
             'cidade_polo_id' => 1,
             'categoria_profissional_id' => 1,
             'programa_id' => 4
        ]);
	    
	    DB::table('residencias')->insert([
             'id' => 9,
             'vagas' => 2,
             'cidade_polo_id' => 1,
             'categoria_profissional_id' => 3,
             'programa_id' => 4
        ]);
	    
	    DB::table('residencias')->insert([
             'id' => 10,
             'vagas' => 2,
             'cidade_polo_id' => 1,
             'categoria_profissional_id' => 5,
             'programa_id' => 4
        ]);
	    
	    DB::table('residencias')->insert([
             'id' => 11,
             'vagas' => 4,
             'cidade_polo_id' => 3,
             'categoria_profissional_id' => 1,
             'programa_id' => 5
        ]);
	    
	    DB::table('cidades')->insert([
	    	'nome' => 'Montes Claros',
	    ]);
	    
	    DB::table('cidades')->insert([
	    	'nome' => 'Taioberas',
	    ]);

        DB::table('condicoes_isencao')->insert([
            'nome' => 'CONDIÇÃO DE DESEMPREGADO',
        ]);

        DB::table('condicoes_isencao')->insert([
            'nome' => 'CONDIÇÃO DE HIPOSSUFICIÊNCIA ECONÔMICA FINANCEIRA',
        ]);
    }
}
