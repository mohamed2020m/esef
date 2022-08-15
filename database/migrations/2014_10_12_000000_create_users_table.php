<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('normal user');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name_arabic')->nullable();
            $table->string('first_name_arabic')->nullable();
            $table->date('birthday')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('cin')->unique()->nullable();
            $table->string('cne')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('photo')->default('student_avatar.jpg');
            $table->string('cin_image_face1')->nullable();
            $table->string('cin_image_face2')->nullable();
            $table->string('code');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
