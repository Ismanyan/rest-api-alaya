<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Treatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name');
        //     $table->string('username');
        //     $table->string('email');
        //     $table->string('password');
        //     $table->longText('address');
        //     $table->string('branch');
        //     $table->string('photo');
        //     $table->string('position');
        //     $table->string('role');
        //     $table->string('pin', 10)->nullable();
        //     $table->string('token')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('users');
    }
}
