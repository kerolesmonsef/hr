<?php

use App\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkFromHomeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_from_home_requests', function (Blueprint $table) {
            $table->id();
            $table -> string('date')->nullable();
            $table -> text('reason')->nullable();
            $table -> foreignIdFor(Employee::class) -> constrained() -> cascadeOnDelete() -> cascadeOnUpdate();
            $table -> string('status') -> default('pending') -> nullable();
            $table -> biginteger('created_by')->nullable();
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
        Schema::dropIfExists('work_from_home_requests');
    }
}
