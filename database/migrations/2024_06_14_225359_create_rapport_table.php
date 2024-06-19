<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRapportTable extends Migration
{
    public function up()
    {
        Schema::create('rapport', function (Blueprint $table) {
            $table->id('rapport_id');
            $table->unsignedBigInteger('admin_user_id');
            $table->unsignedBigInteger('comptable_user_id')->nullable(); // Define the comptable_user_id column
            $table->text('report_details')->nullable();
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('admin_user_id')->references('id')->on('users'); // Assuming 'id' is the correct column in 'users' table
            $table->foreign('comptable_user_id')->references('id')->on('users')->nullable(); // Define foreign key constraint for comptable_user_id
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rapport');
    }
}
