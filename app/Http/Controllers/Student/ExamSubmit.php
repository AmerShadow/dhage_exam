<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\ResultController;
use Illuminate\Http\Request;
use App\StudentExam;
use App\StudentExamAnswer;

class ExamSubmit extends Controller
{
    public function submitExam(Request $request)
    {
        $data = $request['data'];


        $isExamStarted = $data['is_exam_started'];
        $isCompleted = $data['student_exam']['is_completed'];




        if ($isExamStarted && !$isCompleted) {
            $studentExam = StudentExam::find($data['student_exam']['id']);
            $studentExam->time_remaining = 0;
            $isCompleted=$studentExam->is_completed = 1;
            $studentExam->update();


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

            //$studentAttemptedQuestons=StudentExamAnswer::where("student_exam_id")->get();
            // foreach ($studentAttemptedQuestons as $key => $studentAttemptedQueston) {
            //     $studentAttemptedQueston-
            // }

            $studentExam->update();

            return response()->json([
                'status' => "S",
                'message' => "Exam Submitted Successfully",
                'backObject' => $data,
            ]);
        } else {
            if ($isCompleted) {
                return response()->json([
                    "status" => 'F',
                    "message" => 'Your Exam is already submitted',
                    "is_submitted" => '1',
                ]);
            }
            return response()->json([
                "status" => 'F',
                "message" => 'Oops something went wrong',
            ]);
        }
    }


    public function examCompletedMEssage($id)
    {
        $studentExam=StudentExam::find($id);
        $result=ResultController::generateResult($studentExam);
        return view('student.exam_completed_message',compact('result'));
    }
}
