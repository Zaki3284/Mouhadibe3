<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouhasibeCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('mouhasibe_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_user_id');
            $table->foreign('admin_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('comptable_user_id')->nullable();
            $table->foreign('comptable_user_id')->references('id')->on('users')->onDelete('set null'); // Optional comptable
            $table->string('company_name', 191)->unique();
            $table->string('company_address', 255)->nullable(); // Ensure consistency
            $table->string('company_registration', 50)->nullable(); // Ensure consistency
            $table->decimal('total_immobilisation', 15, 2);
            $table->text('details_immobilisation')->nullable();
            $table->decimal('total_actif_a_court_terme', 15, 2);
            $table->text('details_total_actif_a_court_terme')->nullable();
            $table->decimal('total_du_capital', 15, 2);
            $table->text('details_du_capital')->nullable();
            $table->decimal('total_du_passif_court_terme', 15, 2);
            $table->text('details_du_passif_court_terme')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mouhasibe_companies');
    }
}
