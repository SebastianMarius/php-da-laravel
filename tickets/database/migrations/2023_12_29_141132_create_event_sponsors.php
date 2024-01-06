<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event_sponsors', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('sponsors_id');
            
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('sponsors_id')->references('id')->on('sponsors')->onDelete('cascade');
            
            $table->primary(['event_id', 'sponsors_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_sponsor');
    }
};