<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_exams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exams_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

                $table->foreignId('student_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');



            $table->string('exam_seat_no');
            $table->string('is_started')->nullable();
            $table->string('is_completed')->nullable();
            $table->string('result')->nullable();
            $table->string('marks')->nullable();
            $table->string('start_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('time_remaining')->nullable();


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
        Schema::dropIfExists('student_exams');
    }
}
