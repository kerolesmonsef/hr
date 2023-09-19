<?php

use App\Models\AssetsType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTypeAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->foreignIdFor(AssetsType::class)->nullable()->onDelete('SET NULL')->constrained();
            $table->dropColumn('type');

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
            $table->string('type')->nullable();
            $table->dropColumn('assets_type_id');
        });
    }
}
