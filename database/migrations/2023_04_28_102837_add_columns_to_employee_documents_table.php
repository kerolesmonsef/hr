<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEmployeeDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_documents', function (Blueprint $table) {
            $table->integer("document_type_id")->after("document_value")->nullable();
            $table->integer("document_type_value")->after("document_type_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_documents', function (Blueprint $table) {
            $table->dropColumn("document_type_id");
            $table->dropColumn("document_type_value");
        });
    }
}
