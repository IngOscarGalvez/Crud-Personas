<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_apellido');
            $table->string('cedula')->unique();
            $table->string('celular_1')->nullable();
            $table->string('celular_2')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('email')->nullable();
            $table->text('departamenToString')->nullable();
            $table->text('municipioToString')->nullable();
            $table->text('direccion')->nullable();
            $table->text('observaciones_direccion')->nullable();
            $table->text('barrioVeredaToString')->nullable();
            $table->text('vehiculoToString')->nullable();
            $table->text('puestoVotacionToString')->nullable();
            $table->text('candidatoToString')->nullable();
            $table->text('resposableToString')->nullable();
            $table->text('ayuda')->nullable();
            $table->text('observaciones')->nullable();

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
        Schema::dropIfExists('personas');
    }
}
