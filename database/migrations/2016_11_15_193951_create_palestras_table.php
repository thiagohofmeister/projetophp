<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalestrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palestras', function (Blueprint $table) {
            $table->increments('id');
            $table->char('codigo', 16);
            $table->string('titulo', 60);
            $table->string('slug', 100);
            $table->date('data');
            $table->time('hora');
            $table->time('duracao');
            $table->string('foto_capa', 100)->default('images/sem-foto.jpg');
            $table->text('descricao');
            $table->text('conteudos');
            $table->integer('id_palestrante')->unsigned();
            $table->integer('id_evento')->unsigned();
            $table->integer('id_sala')->unsigned();
            $table->foreign('id_palestrante')->references('id')->on('palestrantes');
            $table->foreign('id_evento')->references('id')->on('eventos');
            $table->foreign('id_sala')->references('id')->on('salas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palestras');
    }
}
