<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanPendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_pendings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('start_date')->nullable();
            $table->string('amount')->nullable();
            $table->string('month_nubmer')->nullable();
            $table->string('reason')->nullable();
            $table->biginteger('created_by')->nullable();
            $table->biginteger('employee_id')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->biginteger('loan_option')->default('pending')->nullable();
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
        Schema::dropIfExists('loan_pendings');
    }
}
