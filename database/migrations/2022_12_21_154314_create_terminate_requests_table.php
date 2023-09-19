<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminate_requests', function (Blueprint $table) {
            $table->id();
            $table->biginteger('employee_id')->nullable();
            $table->string('date_termination')->nullable();
            $table->string('date_notify')->nullable();
            $table->string('leave_credit')->nullable();
            $table->string('amount')->nullable();
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('terminate_requests');
    }
}
