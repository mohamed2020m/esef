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
        Schema::create('filiere_licence', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('filiere_id')->unsigned();
            $table->unsignedBigInteger('licence_id')->unsigned();
            $table->string('bonus_licence');
            $table->string('coefficient_licence');
            $table->foreign('filiere_id')->references('id')->on('filieres')->onDelete('cascade');
            $table->foreign('licence_id')->references('id')->on('licences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filiere_licence');
    }
};
