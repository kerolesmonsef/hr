<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToCompnayJobRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_job_requests', function (Blueprint $table) {
            $table->unsignedBigInteger("positions_count")->default(1);
            $table->text("job_requirement")->default('');
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
            $table->dropColumn("job_requirement","positions_count");
        });
    }
}
