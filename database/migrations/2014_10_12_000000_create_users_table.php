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
            $table->string('matricule')->unique();
            $table->string('lastName');
            $table->string('firstName');
            $table->string('sexe');
            $table->string('email')->unique();
            $table->string('tel');
            $table->string('password');
            $table->bigInteger('promotion')->nullable();
            $table->foreignId('speciality_id')->nullable(false)->constrained();
            $table->foreignId('role_id')->nullable(false)->constrained();
            $table->string('profileImg')->default('');
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
