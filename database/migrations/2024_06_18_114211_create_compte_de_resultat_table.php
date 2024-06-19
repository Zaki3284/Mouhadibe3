<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompteDeResultatTable extends Migration
{
    public function up()
    {
        Schema::create('compte_de_resultats', function (Blueprint $table) {
            $table->id();
            $table->string('charge');
            $table->decimal('montant_charge', 10, 2);
            $table->string('produit');
            $table->decimal('montant_produit', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compte_de_resultats');
    }
}
