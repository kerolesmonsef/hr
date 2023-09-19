<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsuranceFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->string('medical_insurance_number')->nullable();
            $table->string('medical_insurance_card_number')->nullable();
            $table->string('medical_insurance_start_date')->nullable();
            $table->string('medical_insurance_end_date')->nullable();
            $table->string('medical_blood_type')->nullable();
            $table->string('medical_insurance_type')->nullable();
            $table->string('medical_cover_ratio')->nullable();
            $table->string('medical_insurance_policy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
}
