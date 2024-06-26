<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateNewRapportsTable extends Migration
{
    public function up()
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->id('rapport_id');
            $table->unsignedBigInteger('admin_user_id');
            $table->unsignedBigInteger('comptable_user_id')->nullable();
            $table->text('compte_de_resultat_details')->nullable();
            $table->text('comments')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('admin_user_id')->references('id')->on('users');
            $table->foreign('comptable_user_id')->references('id')->on('users')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rapports');
    }
}
