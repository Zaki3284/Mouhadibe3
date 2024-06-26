<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('debit_account');
            $table->string('credit_account');
            $table->string('emplois');
            $table->decimal('montant_debit', 10, 2);
            $table->decimal('montant_credit', 10, 2);
            $table->string('journal_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
