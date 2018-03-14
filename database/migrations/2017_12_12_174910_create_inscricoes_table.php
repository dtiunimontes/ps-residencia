<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscricoesTable extends Migration{

    public function up(){
        Schema::create('inscricoes', function(Blueprint $table){
            $table->increments('id');
            $table->boolean('pediu_isencao')->default(0);
            $table->date('data_pediu_isencao')->nullable();
            $table->integer('condicao_isencao_id')->unsigned()->nullable();
            $table->foreign('condicao_isencao_id')->references('id')->on('condicoes_isencao');
            $table->boolean('status_pedido_isencao')->comment('0 - Indeferido, 1 - Deferido')->nullable();
            $table->float('nota_primeira_etapa')->nullable();
            $table->float('nota_segunda_etapa')->nullable();
            $table->tinyInteger('status_segunda_etapa')->default(0)->comment('0 - Sem avaliação, 1 - Deferido, 2 - Indeferido');
            
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->integer('residencia_id')->unsigned();
            $table->foreign('residencia_id')->references('id')->on('residencias');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            
            $table->tinyInteger('status_dae')->default(0);
            $table->string('num_dae', 20)->nullable();
            $table->date('vencimento')->nullable();
            $table->date('mes_referencia')->nullable();
            $table->unique(['usuario_id', 'residencia_id']);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('inscricoes');
    }
}
