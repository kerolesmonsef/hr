<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateStatusInMeetingEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meeting_employees', function (Blueprint $table) {
            // dont change because other way doesn't work with enum
            DB::statement("ALTER TABLE meeting_employees MODIFY COLUMN status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meeting_employees', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
