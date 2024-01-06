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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('bio',255);
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
};

// CREATE TABLE `sponsors` (
//     `id` int NOT NULL AUTO_INCREMENT,
//     `name` varchar(255) NOT NULL,
//     `bio` varchar(255) NOT NULL,
//     PRIMARY KEY (`id`)
//   );