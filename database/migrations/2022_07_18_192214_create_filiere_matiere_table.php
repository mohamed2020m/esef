<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filiere_matiere', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('filiere_id')->unsigned();
            $table->integer('matiere_id')->unsigned();
            $table->string('coefficient_matiere')->default('1');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filiere_matiere');
    }
};
