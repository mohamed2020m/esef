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
            $table->integer('bac_id')->unsigned();
            $table->integer('filiere_id')->unsigned();
            $table->string('bonus_bac')->default('0');
            $table->string('coefficient_bac')->default('1');
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