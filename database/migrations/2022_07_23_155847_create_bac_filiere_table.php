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
        Schema::create('bac_filiere', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bac_id')->unsigned();
            $table->unsignedBigInteger('filiere_id')->unsigned();
            $table->string('bonus_bac')->default('0');
            $table->string('coefficient_bac')->default('1');
            $table->foreign('bac_id')->references('id')->on('bacs')->onDelete('cascade');
            $table->foreign('filiere_id')->references('id')->on('filieres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bac_filiere');
    }
};
