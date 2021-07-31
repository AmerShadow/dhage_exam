<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exams_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');



                $table->string('question_type')->nullable();
                $table->string('question');
                $table->string('option_a')->nullable();
                $table->string('option_b')->nullable();
                $table->string('option_c')->nullable();
                $table->string('option_d')->nullable();
                $table->string('option_e')->nullable();

                $table->string('answer');






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
        Schema::dropIfExists('exam_questions');
    }
}
