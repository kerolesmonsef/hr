<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnsToLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leaves', function (Blueprint $table) {
            //
            $table->dropColumn('employee_id');
            $table->dropColumn('leave_type_id');
            $table->dropColumn('ticket');
            $table->dropColumn('leave_reason_ar');
            $table->dropColumn('created_by');
            $table->dropColumn('remark');
            $table->dropColumn('remark_ar');
            $table->dropColumn('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaves', function (Blueprint $table) {
            //
        });
    }
}
