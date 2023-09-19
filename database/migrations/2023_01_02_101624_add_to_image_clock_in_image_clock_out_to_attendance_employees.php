<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToImageClockInImageClockOutToAttendanceEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_employees', function (Blueprint $table) {
            //
            $table->string('image_clock_in')->nullable();
            $table->string('image_clock_out')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_employees', function (Blueprint $table) {
            //
        });
    }
}
