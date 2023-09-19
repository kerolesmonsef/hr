<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStructureKeyToCompanyStructuresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_structures', function (Blueprint $table) {
            $table->string('structure_key')->after('parent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_structures', function (Blueprint $table) {
            $table->dropColumn('structure_key');
        });
    }
}
