<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandaboutcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landaboutcards', function (Blueprint $table) {
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
        Schema::dropIfExists('landaboutcards');
    }
}
