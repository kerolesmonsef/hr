<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDucumentUploadCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_ducument_upload_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_ar')->nullable();
            $table->softDeletes();
            $table->biginteger('created_by')->nullable();
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
        Schema::dropIfExists('company_ducument_upload_categories');
    }
}
