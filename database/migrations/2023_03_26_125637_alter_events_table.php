<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('time', 'start_time');
            $table->time('end_time')->nullable();
            $table->string('lectures')->nullable();
            $table->string('location')->nullable();
            $table->text('about')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('start_time', 'time');
            $table->dropColumn(['end_time', 'lectures', 'location', 'about']);
        });
    }
}
