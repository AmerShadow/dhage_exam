<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StudentExam;

class ExamSubmit extends Controller
{
    public function submitExam(Request $request)
    {
        $data = $request['data'];

        $questions = $data['questions'];
        $student = $data['student'];
        $studentExam = $data['student_exam'];

        $isExamStarted = $data['is_exam_started'];
        $isCompleted = $data['student_exam']['is_completed'];




        if ($isExamStarted && !$isCompleted) {
            $studentExam = StudentExam::find($data['student_exam']['id']);

            return response()->json([
                'studentExam' => $studentExam,
                "backObject" => $data,
            ]);
        } else {
            return response()->json([
                "status" => 'F',
                "message" => 'Either exam is not competed or Exam is comleted',
            ]);
        }


        return response()->json([
            "backObject" => $data,
        ]);
    }
}
