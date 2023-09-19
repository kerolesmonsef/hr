<?php

use App\Models\Document;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDucumentUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'ducument_uploads', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('role');
            $table->string('document');
            $table->text('description')->nullable();
            $table->integer('created_by')->default(0);
            $table->string('exp_date')->nullable();
            $table->foreignIdFor(Document::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ducument_uploads');
    }
}
