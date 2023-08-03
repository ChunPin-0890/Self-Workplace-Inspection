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
        Schema::create('executions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subplanning_id')->nullable();

        // Foreign key constraint
        $table->foreign('subplanning_id')->references('id')->on('subplannings')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('execution_inspection', function (Blueprint $table) {
            $table->unsignedBigInteger('execution_id');
            $table->unsignedBigInteger('inspection_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('executions');
    }
};
