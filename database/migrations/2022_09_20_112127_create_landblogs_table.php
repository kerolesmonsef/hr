<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandblogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landblogs', function (Blueprint $table) {
            $table->id();
            $table->text('titleEn')->nullable();
            $table->text('titleAr')->nullable();
            $table->text('descriptionEn')->nullable();
            $table->text('descriptionAr')->nullable();
            $table->string('image')->nullable();

            //seo
            $table->text('metaTitleEn')->nullable();
            $table->text('metaTitleAr')->nullable();

            $table->text('metaDescriptionEn')->nullable();
            $table->text('metaDescriptionAr')->nullable();

            $table->text('metakeyEn')->nullable();
            $table->text('metakeyAr')->nullable();

            $table->text('metaTagEn')->nullable();
            $table->text('metaTagAr')->nullable();
            //seo
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
        Schema::dropIfExists('landblogs');
    }
}
