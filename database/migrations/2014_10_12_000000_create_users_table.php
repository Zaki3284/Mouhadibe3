<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable()->unique();
            $table->string('email')->unique()->nullable(); // Nullable if also using phone number
            $table->string('password');
            $table->string('phone_number')->unique()->nullable(); // Nullable if also using email
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->string('role')->default('user');
            $table->boolean('is_confirmed')->default(false);
            $table->string('confirmation_token', 60)->nullable();
            $table->string('password_reset_token')->nullable();
            $table->timestamp('password_reset_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
