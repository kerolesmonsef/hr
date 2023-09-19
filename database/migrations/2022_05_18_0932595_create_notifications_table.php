<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('body')->nullable();
            $table->string('body_ar')->nullable();
            $table->tinyInteger('read')->default(0);
            $table->integer('created_by');
            $table->tinyInteger('for_admin')->default(1);
            $table->text('redirect_url')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
