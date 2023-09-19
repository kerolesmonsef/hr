<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_breaks', function (Blueprint $table) {
            $table->id();
            $table->biginteger('employee_id')->nullable();
            $table->biginteger('break_id')->nullable();
            $table->String('start_time')->nullable();
            $table->String('end_time')->nullable();
            $table->biginteger('created_by')->nullable();
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
        Schema::dropIfExists('employee_breaks');
    }
}
