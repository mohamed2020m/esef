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
        Schema::create('bac_user', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('bac_id')->unsigned();
            $table->string('type_bac');
            $table->string('annee_obtention');
            $table->string('etablissment_obtention');
            $table->string('ville_obtention');
            $table->string('scan_bac');
            $table->string('scan_releve_note');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bac_id')->references('id')->on('bacs')->onDelete('cascade');


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
        Schema::dropIfExists('bac_user');
    }
};
