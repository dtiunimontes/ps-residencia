<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadesPolosTable extends Migration{
 
	public function up(){
        Schema::create('cidades_polos', function(Blueprint $table){
            $table->increments('id');
            $table->string('nome');
            $table->timestamps();
        });
    }
    
    public function down(){
        Schema::dropIfExists('cidades_polos');
    }
}
