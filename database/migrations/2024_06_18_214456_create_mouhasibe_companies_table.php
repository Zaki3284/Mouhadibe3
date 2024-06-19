<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Drop the table if it already exists
        Schema::dropIfExists('mouhasibe_companies');

        // Create the table
        Schema::create('mouhasibe_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_user_id');
            $table->foreign('admin_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name', 191)->unique(); // Adjusted length to 191 characters
            $table->string('address', 255)->nullable();
            $table->string('registration_number', 50)->nullable();
            $table->decimal('total_immobilisation', 15, 2)->nullable();
            $table->text('details_immobilisation')->nullable();
            $table->decimal('total_actif_a_court_terme', 15, 2)->nullable();
            $table->text('details_total_actif_a_court_terme')->nullable();
            $table->decimal('total_du_capital', 15, 2)->nullable();
            $table->text('details_du_capital')->nullable();
            $table->decimal('total_du_passif_court_terme', 15, 2)->nullable();
            $table->text('details_du_passif_court_terme')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouhasibe_companies');
    }
};
