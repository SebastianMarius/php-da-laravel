<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event_partners', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('partners_id');
            
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('partners_id')->references('id')->on('partners')->onDelete('cascade');
            
            $table->primary(['event_id', 'partners_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_partners');
    }
};
