<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuestas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->text('detalle')->nullable();
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('secunda_asoc');
            $table->integer('secunda_id');
            $table->boolean('estado')->default(false);
            // $table->integer('aprovaciones')->default(0);
            // $table->integer('desaprovaciones')->default(0);
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
        Schema::dropIfExists('propuestas');
    }
}
