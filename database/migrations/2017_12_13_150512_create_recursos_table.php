<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursosTable extends Migration{
 
	public function up(){
        Schema::create('recursos', function(Blueprint $table){
            $table->increments('id');
            $table->tinyInteger('tipo')->comment('1 - Recurso do pedido de isenção, 2 - Recurso de Tratamento Especial, 3 - Recurso de primeira Etapa, 4 - Recurso de segunda etapa');
	        $table->integer('inscricao_id')->unsigned();
	        $table->foreign('inscricao_id')->references('id')->on('inscricoes');
	        $table->text('resposta_recurso');
	        $table->unique(['inscricao_id', 'tipo']);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('recursos');
    }
}
