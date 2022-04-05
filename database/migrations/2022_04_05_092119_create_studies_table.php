<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->unsigned();
            $table->integer('lecture_id')->unsigned();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
            $table->foreign('student_id', 'study_fk0')->references('id')->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('lecture_id', 'study_fk1')->references('id')->on('lectures')
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
        Schema::dropIfExists('studies');
    }
};
