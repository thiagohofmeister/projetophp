<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosPalestrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos_palestras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_aluno')->unsigned();
            $table->integer('id_palestra')->unsigned();
            $table->char('presente', 1)->default('0');
            $table->foreign('id_aluno')->references('id')->on('alunos');
            $table->foreign('id_palestra')->references('id')->on('palestras');
            $table->unique(['id_aluno', 'id_palestra']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos_palestras');
    }
}
