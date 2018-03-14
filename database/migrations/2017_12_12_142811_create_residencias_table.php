<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidenciasTable extends Migration{
    
    public function up(){
        Schema::create('residencias', function(Blueprint $table){
	        $table->integer('id')->unsigned();
	        $table->primary('id');
	        $table->integer('vagas')->unsigned();
	        $table->integer('cidade_polo_id')->unsigned();
	        $table->foreign('cidade_polo_id')->references('id')->on('cidades_polos');
	        $table->integer('categoria_profissional_id')->unsigned();
	        $table->foreign('categoria_profissional_id')->references('id')->on('categorias_profissionais');
	        $table->integer('programa_id')->unsigned();
	        $table->foreign('programa_id')->references('id')->on('programas');
	        $table->unique(['cidade_polo_id', 'categoria_profissional_id', 'programa_id'], 'unique_key_residencias');
        });
    }

    public function down(){
        Schema::dropIfExists('residencias');
    }
}
