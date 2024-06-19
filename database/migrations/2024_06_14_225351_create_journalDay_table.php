<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalDayTable extends Migration
{
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comptable_user_id');
            $table->foreign('comptable_user_id')->references('id')->on('users');
            $table->date('date');
            $table->text('entry_details')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
