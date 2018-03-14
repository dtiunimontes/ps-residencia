<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration{

    public function up(){
        Schema::create('configs', function(Blueprint $table){
            $table->increments('id');
            $table->dateTime('termino_inscricoes');
            $table->dateTime('termino_pedido_isencao');
            $table->dateTime('termino_pagamento_dae');
            $table->dateTime('dia_limite_pag_dae_indeferidos');
        });
    }

    public function down(){
        Schema::dropIfExists('configs');
    }
}
