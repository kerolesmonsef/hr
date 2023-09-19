<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->date('purchase_date')->nullable()->change();
            $table->date('supported_date')->nullable()->change();
            $table->integer('created_by')->nullable()->default('NULL')->change();
            $table->string('serial_number')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['serial_number', 'status','type']);
        });
    }
}
