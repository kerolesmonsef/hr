<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissiedColumnsToEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluation_answers', function (Blueprint $table) {
            if (!Schema::hasColumn("evaluation_answers","employee_id")){
                $table->unsignedBigInteger("employee_id");
            }
            if (!Schema::hasColumn("evaluation_answers","result")){
                $table->text("result")->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluation_answers', function (Blueprint $table) {
            //
        });
    }
}
