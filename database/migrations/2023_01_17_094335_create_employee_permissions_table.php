<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('created_by')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('status') -> default('pending') -> nullable();
            $table->text('message') -> nullable();
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
        Schema::dropIfExists('employee_permissions');
    }
}
