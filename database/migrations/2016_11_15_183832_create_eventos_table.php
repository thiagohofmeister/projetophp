<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 50);
            $table->string('slug', 100);
            $table->text('descricao');
            $table->dateTime('data_insc_inicio');
            $table->dateTime('data_insc_fim');
            $table->dateTime('data_rea_inicio');
            $table->dateTime('data_rea_fim');
            $table->dateTime('data_exi_inicio');
            $table->dateTime('data_exi_fim');
            $table->string('foto_capa', 100)->default('images/sem-foto.jpg');
            $table->char('status', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
