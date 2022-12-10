<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceline', function (Blueprint $table) {
            $table->id();      
            $table->foreignId('service_id');
            $table->foreign('service_id')->references('id')->on('service')->onDelete('cascade');
            $table->foreignId('pet_id');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
            $table->foreignId('groomings_id');
            $table->foreign('groomings_id')->references('id')->on('groomings')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serviceline');
    }
};
