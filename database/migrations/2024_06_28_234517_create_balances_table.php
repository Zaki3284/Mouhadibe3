<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalancesTable extends Migration
{
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->string('account', 50);
            $table->string('description')->default('')->nullable();
            $table->decimal('movement_debit', 15, 2)->default(0);
            $table->decimal('movement_credit', 15, 2)->default(0);
            $table->decimal('balance_debit', 15, 2)->default(0);
            $table->decimal('balance_credit', 15, 2)->default(0);
            $table->string('code_journal')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->unique(['account', 'code_journal', 'date']); // Ensuring each account, code_journal, and date combination is unique
        });
    }

    public function down()
    {
        Schema::dropIfExists('balances');
    }
}
