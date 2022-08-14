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
        Schema::create('licence_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('licence_id')->unsigned();
            $table->string('type_licence');
            $table->string('annee_obtention');
            $table->string('etablissment_obtention');
            $table->string('ville_obtention');
            $table->string('note_s1');
            $table->string('note_s2');
            $table->string('releve_s1');
            $table->string('releve_s2');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('licence_id')->references('id')->on('licences')->onDelete('cascade');
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
        Schema::dropIfExists('licence_user');
    }
};
