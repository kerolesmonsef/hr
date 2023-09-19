<?php

use App\Models\PerformancePeriod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performance', function (Blueprint $table) {
            $table->foreignIdFor(PerformancePeriod::class)->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance', function (Blueprint $table) {
            $table->dropConstrainedForeignId(PerformancePeriod::class);
        });
    }
}
