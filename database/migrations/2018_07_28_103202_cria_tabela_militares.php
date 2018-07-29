<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaMilitares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('militares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('identidade');
            $table->date('data_nascimento');
            $table->boolean('servico_militar_obrigatorio');
            $table->enum('patente', ['Soldado', 'Cabo', 'Sargento', 'Subtenente', 'Tenente', 'Capitão', 'General']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('militares');
    }
}
