<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\ExamQuestion;
use App\Http\Controllers\Controller;
use App\Student;
use App\StudentExam;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\throwException;

class ExamController extends Controller
{
    public function startExamView($examId)
    {
        try {
            $exam = $this->getExam($examId);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


        return view('student.get_student_details', compact('exam'));
    }




    public function startExamPost(Request $request, $examId)
    {
        $request->validate([
            "exam_seat_no" => "required|exists:students,exam_seat_no",
            "password" => 'required|exists:students,password',
        ]);

        $exam = $this->getExam($examId);
        $examinee = $this->getExaminee($request,$exam->id);

        if ($examinee,$exam) {
            # code...
        }
        if(!$examinee){
            return "This test is not for your batch";
        }
        $checkExamDateValidation = $this->examDateValidation($exam);

        if ($checkExamDateValidation !== 0) {
            return $checkExamDateValidation;
        }

        $questionPaper = $this->getQuestionPaper($exam);
        return $questionPaper;
    }





    public function getQuestionPaper(Exam $exam)
    {
        try {
            return response()->json(ExamQuestion::where('exams_id', $exam->id)->get());
        } catch (\Throwable $th) {
            throw new Exception("Exam Not Found", 1);
        }
    }

    public function getExaminee(Request $request,$id)
    {
        return Student::where('exam_seat_no', $request->exam_seat_no)
        ->where('password', $request->password)
        ->where('batch',$id)
        ->first();
    }

    public function getExam($id)
    {
        try {
            return Exam::findOrFail($id);
        } catch (\Throwable $th) {
            throw new Exception("Exam Not Found", 1);
        }
    }


    public function examDateValidation(Exam $exam)
    {
        $start_date = date('Y-m-d h:i:s', strtotime($exam->start_date));
        $end_date = date('Y-m-d h:i:s', strtotime($exam->end_date));

        $now = date(Carbon::now());

        if ($start_date > $now) {
            return "your exam is not started yet";
        }


        if ($end_date < $now) {
            return "your exam is completed";
        }
        return 0;
    }

    public function checkExamStartedStatus(Student $student,Exam $exam){
            return StudentExam::where('exams_id',$exam->id)
                ->where('student_id',$student->id)
                ->where('is_started','>',0)
                ->where('is_submitted')
                ->exists();
    }


}
