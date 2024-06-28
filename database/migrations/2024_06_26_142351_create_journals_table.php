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
            $table->date('Date');
            $table->string('Numero_de_Compte');
            $table->foreign('Numero_de_Compte')->references('Numero_de_Compte')->on('comptes');
            $table->string('Libelle');
            $table->decimal('Montant_Debit', 15, 2)->nullable();
            $table->decimal('Montant_Credit', 15, 2)->nullable();
            $table->string('Code_Journal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
