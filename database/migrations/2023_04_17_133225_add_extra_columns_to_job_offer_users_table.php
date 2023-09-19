<?php

use App\Models\Nationality;
use App\Models\Qualification;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToJobOfferUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_offer_users', function (Blueprint $table) {
            $table->date("date_of_birth");
            $table->string("gender");
            $table->foreignIdFor(Nationality::class);
            $table->foreignIdFor(Qualification::class);
            $table->string("country");
            $table->string("city");
            $table->string("area")->nullable();
            $table->string("phone");
            $table->string("email");
            $table->string("field_of_study")->nullable();
            $table->string("university")->nullable();
            $table->string("graduation_year")->nullable();
            $table->string("grade")->nullable();
            $table->string("portfolio_link")->nullable();
            $table->boolean("is_seen")->default("0");
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
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
            $table->dropForeign(['nationality_id']);
            $table->dropColumn('nationality_id');
            $table->dropForeign(['qualification_id']);
            $table->dropColumn('qualification_id');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('area');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('field_of_study');
            $table->dropColumn('university');
            $table->dropColumn('graduation_year');
            $table->dropColumn('grade');
            $table->dropColumn('portfolio_link');
            $table->dropColumn('is_seen');
        });
    }
}
