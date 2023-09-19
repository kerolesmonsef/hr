<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandslidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landsliders', function (Blueprint $table) {
            $table->id();
            $table->text('titleEn')->nullable();
            $table->text('titleAr')->nullable();
            $table->text('descriptionEn')->nullable();
            $table->text('descriptionAr')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('landsliders');
    }
}
