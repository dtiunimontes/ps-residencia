<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessoSeletivosTable extends Migration{

    public function up(){
        Schema::create('processo_seletivos', function(Blueprint $table){
            $table->increments('id');
            $table->string('nome')->unique();
            $table->text('descricao');
            $table->boolean('atual');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('processo_seletivos');
    }
}
