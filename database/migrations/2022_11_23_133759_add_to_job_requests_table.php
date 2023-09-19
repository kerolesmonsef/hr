<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToJobRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_requests', function (Blueprint $table) {
            //
            $table->text('address')->nullable();
            $table->text('education')->nullable();
            $table->string('experience')->nullable();
            $table->text('linkedin_profile')->nullable();
            $table->string('join_us_date')->nullable();
            $table->string('salary')->nullable();
            $table->string('english_rate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_requests', function (Blueprint $table) {
            //
        });
    }
}
