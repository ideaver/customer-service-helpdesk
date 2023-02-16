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
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('user_id', true);
            $table->string('uuid', 64)->nullable();
            $table->bigInteger('role_id')->nullable();
            $table->text('image_profile')->nullable();
            $table->string('fullname', 512)->default('');
            $table->string('email', 512)->default('');
            $table->string('phone', 16)->nullable();
            $table->string('password', 512)->default('');
            $table->string('fcm_token', 256)->nullable();
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('users');
    }
};
