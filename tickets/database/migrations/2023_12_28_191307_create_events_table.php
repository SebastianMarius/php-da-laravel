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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->string('image_url',255);
            $table->string('stripe_product_id',255);
            $table->string('stripe_price_id', 255);
            $table->string('location',255);
            $table->string('description',255);
            $table->integer('tichet_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};

// CREATE TABLE `events` (
//     `id` int NOT NULL AUTO_INCREMENT,
//     `title` varchar(255) NOT NULL,
//     `start_date` date NOT NULL,
//     `start_time` time NOT NULL,
//     `end_date` date NOT NULL,
//     `end_time` time NOT NULL,
//     `location` varchar(255) NOT NULL,
//     `description` varchar(255) NOT NULL,
//     `speaker_id` int NOT NULL,
//     `partner_id` int NOT NULL,
//     `sponsor_id` int NOT NULL,
//     `ticket_price` decimal(10,2) NOT NULL,
//     PRIMARY KEY (`id`),
//     KEY `speaker_id` (`speaker_id`),
//     KEY `partner_id` (`partner_id`),
//     KEY `sponsor_id` (`sponsor_id`)
//   );
