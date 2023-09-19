<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCompanyJobRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_job_requests', function (Blueprint $table) {
            $table -> string('job_type')->nullable();
            $table -> string('experience')->nullable();
            $table -> string('career_level')->nullable();
            $table -> string('salary')->nullable();
            $table -> string('form_link')->nullable();
            $table -> string('company_name')->nullable();
            $table -> string('company_location')->nullable();
            $table -> longtext('job_description')->nullable();
            $table -> string('company_logo')->nullable();
            $table -> string('education_level') -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_job_requests', function (Blueprint $table) {
            //
        });
    }
}
