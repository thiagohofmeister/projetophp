<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalestrasRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palestras_recursos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_palestra')->unsigned();
            $table->integer('id_recurso')->unsigned();
            $table->foreign('id_palestra')->references('id')->on('palestras');
            $table->foreign('id_recurso')->references('id')->on('recursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palestras_recursos');
    }
}
