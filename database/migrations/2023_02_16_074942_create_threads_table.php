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
        Schema::create('threads', function (Blueprint $table) {
            $table->bigInteger('thread_id', true);
            $table->string('thread_no', 32)->nullable();
            $table->bigInteger('thread_topic_id')->nullable();
            $table->bigInteger('user_id_1')->nullable();
            $table->bigInteger('user_id_2')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('rating')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
};
