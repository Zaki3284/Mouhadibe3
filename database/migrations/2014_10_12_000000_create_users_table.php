<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Changed to 'id' instead of 'user_id' for consistency with Laravel conventions
            $table->string('username', 100)->unique();
            $table->string('password', 100);
            $table->string('role')->default('user'); // Using enum for predefined roles
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
