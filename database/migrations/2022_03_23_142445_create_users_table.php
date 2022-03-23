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
    # ['user_id', 'email', 'first_name', 'last_name', 'password'];
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            # Incrementing ID (primary key) using a "UNSIGNED INTEGER" equivalent.
            $table->increments('user_id');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
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
};
