<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInterviewDateFromAndToToJobOfferUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_offer_users', function (Blueprint $table) {
            $table->timestamp('interview_from')->nullable();
            $table->timestamp('interview_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_offer_users', function (Blueprint $table) {
             $table->dropColumn('interview_from');
             $table->dropColumn('interview_to');
        });
    }
}
