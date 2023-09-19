<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmReceiveSalaryToPayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_slips', function (Blueprint $table) {
            $table->boolean('confirm_receive_salary')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_slips', function (Blueprint $table) {
             $table->dropColumn('confirm_receive_salary');
        });
    }
}
