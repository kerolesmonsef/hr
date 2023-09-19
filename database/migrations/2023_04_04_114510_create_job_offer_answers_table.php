<?php

use App\Models\CompanyJobRequest;
use App\Models\JobOfferQuestion;
use App\Models\JobOfferUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOfferAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offer_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JobOfferUser::class)->constrained();
            $table->foreignIdFor(CompanyJobRequest::class)->constrained();
            $table->foreignIdFor(JobOfferQuestion::class)->constrained();
            $table->text('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_offer_answers');
    }
}
