<?php

use App\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverTimeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_time_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class);
            $table->date("date");
            $table->time("start");
            $table->time("end");
            $table->text("reason");
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
        Schema::dropIfExists('over_time_requests');
    }
}
