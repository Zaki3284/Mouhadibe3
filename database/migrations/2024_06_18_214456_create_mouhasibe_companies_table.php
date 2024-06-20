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
            $table->foreignId('admin_user_id')->constrained('users')->default(404);
            $table->foreignId('comptable_user_id')->nullable()->constrained('users');
            $table->string('company_name');
            $table->string('company_address')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mouhasibe_companies');
    }
}
