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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id')->unsigned();
            $table->integer('lecture_id')->unsigned();
            $table->timestamps();
            $table->foreign('group_id', 'plans_fk0')->references('id')->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('lecture_id', 'plans_fk1')->references('id')->on('lectures')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
