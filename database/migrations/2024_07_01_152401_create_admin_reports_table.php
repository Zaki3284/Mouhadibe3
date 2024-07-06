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
        Schema::create('admin_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->text('comments');
            $table->boolean('read_by_admin')->default(false); // New column for admin read status
            $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_reports');
    }
};
