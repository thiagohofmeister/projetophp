<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalestrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palestrantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 40);
            $table->text('curriculo');
            $table->string('foto', 100)->default('images/sem-foto.jpg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palestrantes');
    }
}
