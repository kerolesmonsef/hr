<?php

use App\Models\EvaluationSection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSectionIdToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->foreignIdFor(EvaluationSection::class)
                ->nullable()
                ->after("id")
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedBigInteger("parent_id")->nullable();

            $table->float("point")->nullable()->comment("null if has multi select");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
        });
    }
}
