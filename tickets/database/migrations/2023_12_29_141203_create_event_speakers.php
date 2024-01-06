<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event_speakers', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('speakers_id');
            
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('speakers_id')->references('id')->on('speakers')->onDelete('cascade');
            
            $table->primary(['event_id', 'speakers_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_speakers');
    }
};