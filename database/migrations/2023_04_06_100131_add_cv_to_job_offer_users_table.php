<?php

use App\Models\CompanyJobRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCvToJobOfferUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_offer_users', function (Blueprint $table) {
            $table->string("cv")->nullable();
            $table->foreignIdFor(CompanyJobRequest::class)->nullable()->constrained();
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
            $table->dropColumn("cv");
            $table->dropConstrainedForeignId(CompanyJobRequest::class);
        });
    }
}
