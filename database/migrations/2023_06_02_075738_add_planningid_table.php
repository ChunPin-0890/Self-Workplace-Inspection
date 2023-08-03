<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subplannings', function (Blueprint $table) {
            $table->bigInteger('planning_id')->default(0);
            $table->dropForeign('subplannings_ou_id_foreign');
            $table->dropColumn('ou_id');
            $table->dropForeign('subplannings_group_id_foreign');
            $table->dropColumn('group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subplannings', function (Blueprint $table) {
            $table->dropColumn('planning_id');
            $table->bigInteger('ou_id')->nullable();
            $table->bigInteger('group_id')->nullable();
        });
    }
};
