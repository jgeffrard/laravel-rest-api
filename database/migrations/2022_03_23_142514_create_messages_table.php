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
    # columns = message_id, sender_user_id, message, date, receiver_user_id
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            # Incrementing ID (primary key) using a "UNSIGNED INTEGER" equivalent.
            $table->increments('message_id');
            $table->integer('sender_user_id');
            $table->string('message');
            $table->dateTime('date');
            $table->integer('receiver_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};