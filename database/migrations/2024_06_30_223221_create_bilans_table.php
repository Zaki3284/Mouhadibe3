<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilansTable extends Migration
{
    public function up()
    {
        Schema::create('bilans', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('account');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bilans');
    }
}
