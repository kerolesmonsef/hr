<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddMonthsNoToPerformancePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `performance_periods` DROP `after_months`;");

        Schema::table('performance_periods', function (Blueprint $table) {
            $table->integer('months_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_periods', function (Blueprint $table) {
            $table->integer('months_no');
        });
    }
}
