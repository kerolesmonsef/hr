<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_types', function (Blueprint $table) {
            //
            $table->string('type')->nullable();
            $table->dropColumn('days');
            $table->integer('maxDays')->nullable();
            $table->integer('maxDaysPerMonth')->nullable();
            $table->integer('afterMaxHour')->nullable();
            $table->boolean('sameDay')->nullable();
            $table->float('deduction')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_types', function (Blueprint $table) {
            //

        });
    }
}
