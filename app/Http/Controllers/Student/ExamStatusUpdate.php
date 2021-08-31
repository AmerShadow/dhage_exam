<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\ResultController;
use Illuminate\Http\Request;
use App\StudentExam;
use App\StudentExamAnswer;
use phpDocumentor\Reflection\PseudoTypes\False_;

class ExamStatusUpdate extends Controller
{
    public function updateExamStatus(Request $request)
    {

        $data = $request['data'];
        $isExamStarted = $data['is_exam_started'];
        $isCompleted = $data['student_exam']['is_completed'] ;

        // return response()->json([
        //         "isExamStarted" => $data['is_exam_started'],
        //         "isCompleted" => $data['student_exam']['is_completed'],
        //         "data" => $data,
        //     ]);

        if ($isExamStarted && $isCompleted == "0") {

            $studentExam = StudentExam::find($data['student_exam']['id']);
            if ($studentExam->time_remaining < 5) {

                $studentExam->time_remaining = 0;
                $studentExam->is_completed = 1;
                $studentExam->update();

                return response()->json([
                    "status" => 'F',
                    "message" => 'Exam is comleted.',
                    "is_submitted" => '1',
                ]);
            } else {
                $studentExam->time_remaining -= 5;
                $studentExam->update();
            }

            foreach ($data['questions'] as $key => $question) {

                if (StudentExamAnswer::where('student_exams_id', $studentExam->id)
                    ->where('exam_questions_id', $question['id'])->exists()
                ) {

                    $studentExamAnswer = StudentExamAnswer::where('student_exams_id', $data['student_exam']['id'])
                        ->where('exam_questions_id', $question['id'])->first();
                    $studentExamAnswer->answer = $question['selected_answer'];
                    $studentExamAnswer->update();
                } else {

                    $studentExamAnswer = new StudentExamAnswer();
                    $studentExamAnswer->student_exams_id = $studentExam->id;
                    $studentExamAnswer->exam_questions_id = $question['id'];
                    $studentExamAnswer->answer = $question['selected_answer'];
                    $studentExamAnswer->save();
                }
            }

           // $studentExam->update();

            return response()->json([
                'status' => "S",
                'message' => "Exam status updated Successfully",
                'backObject' => $data,
            ]);
        } else {

            if (!$isExamStarted) {

                return response()->json([
                    "status" => 'F',
                    "message" => 'Exam is not started.',
                ]);
            }

            if ($isCompleted != "0") {

                // return response()->json([
                //     "isExamStarted" => $data['is_exam_started'],
                //     "isCompleted" => $data['student_exam']['is_completed'],
                //     "data" => $data,
                // ]);

                return response()->json([
                    "status" => 'F',
                    "message" => 'Exam is comleted.',
                    "is_submitted" => '1',
                ]);
            }

            return response()->json([
                "status" => 'F',
                "message" => 'Oops.! something went wrong',
            ]);
        }


        return response()->json([
            "backObject" => $data,
        ]);
    }
}
