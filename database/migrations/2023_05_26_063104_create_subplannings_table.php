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
        Schema::create('subplannings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ou_id')
            ->constrained('oprunits');
            $table->string('start_date');
            $table->string('end_date');
            $table->foreignId('group_id')//name of column
            ->constrained('groups')//table name
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('schedule_ou', function (Blueprint $table) {
            $table->unsignedBigInteger('subplanning_id');
            $table->unsignedBigInteger('ou_id');
        });
        Schema::create('schedule_group', function (Blueprint $table) {
             $table->unsignedBigInteger('subplanning_id');
              $table->unsignedBigInteger('group_id');
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subplannings');
     
    }
};
