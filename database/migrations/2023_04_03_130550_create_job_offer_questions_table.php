<?php

use App\Models\JobOfferSection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOfferQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offer_questions', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->foreignIdFor(JobOfferSection::class)->constrained()->cascadeOnDelete();
            $table->string("type");
            $table->float("point")->default(0);
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
        Schema::dropIfExists('job_offer_questions');
    }
}
