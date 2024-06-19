<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceTable extends Migration
{
    public function up()
    {
        Schema::create('balance', function (Blueprint $table) {
            $table->id('balance_id');
            $table->unsignedBigInteger('comptable_user_id');
            $table->string('account_name', 255);
            $table->decimal('balance_amount', 10, 2);
            $table->foreign('comptable_user_id')->references('user_id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('balance');
    }
}
