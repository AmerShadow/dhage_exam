<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StudentExam;
use App\StudentExamAnswer;

class ExamStatusUpdate extends Controller
{
    public function updateExamStatus(Request $request)
    {
       // return response()->json(["hello"]);
        $data = $request['data'];

        $questions = $data['questions'];
        $student = $data['student'];
        $studentExam = $data['student_exam'];

        $isExamStarted = $data['is_exam_started'];
        $isCompleted = $data['student_exam']['is_completed'];




        if ($isExamStarted && !$isCompleted) {
            $studentExam = StudentExam::find($data['student_exam']['id']);

            if ($studentExam->time_remaining < 5) {
                $studentExam->time_remaining = 0;
                $studentExam->is_completed = 1;
            } else {
                $studentExam->time_remaining = $studentExam->time_remainings - 5;
            }

            foreach ($data['questions'] as $key => $question) {
                //return response()->json($question);
                if (StudentExamAnswer::where('student_exams_id', $studentExam->id)
                    ->where('exam_questions_id', $question['id'])->exists()
                ) {

                    $studentExamAnswer = StudentExamAnswer::where('student_exams_id', $studentExam->id)
                        ->where('exam_questions_id', $questions->id)->first();

                    $studentExamAnswer->answer = $question['selected_answer'];
                    $studentExamAnswer->update();
                } else {
                    $studentExamAnswer = new StudentExamAnswer();
                    $studentExamAnswer->student_exams_id=$studentExam->id;
                    $studentExamAnswer->exam_questions_id=$question['id'];
                    $studentExamAnswer->answer=$question['selected_answer'];
                    $studentExamAnswer->save();
                }
            }

            //$studentAttemptedQuestons=StudentExamAnswer::where("student_exam_id")->get();
            // foreach ($studentAttemptedQuestons as $key => $studentAttemptedQueston) {
            //     $studentAttemptedQueston-
            // }

            $studentExam->update();

            return response()->json(['studentExam' => $studentExam]);
        } else {
            return response()->json([
                "status" => 'F',
                "message" => 'Either exam is not started or Exam is comleted',
            ]);
        }


        return response()->json([
            "backObject" => $data,
        ]);
    }
}
