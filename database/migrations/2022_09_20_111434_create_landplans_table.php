<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landplans', function (Blueprint $table) {
            $table->id();
            $table->enum('type' , ['lite' , 'regular' , 'pro'])->nullable();
            $table->string('price')->nullable();
            $table->enum('dateType' , ['monthly' , 'yearly'])->nullable();
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
        Schema::dropIfExists('landplans');
    }
}
