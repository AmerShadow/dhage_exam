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
    private $exam, $student, $request, $studentExam;
    public function startExamView($examId)
    {
        try {
            $this->exam = $this->getExam($examId);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        return view('student.get_student_details')->with('exam', $this->exam);
    }




    public function startExamPost(Request $request, $examId)
    {
        $request->validate([
            "exam_seat_no" => "required|exists:students,exam_seat_no",
            "password" => 'required|exists:students,password',
        ]);

        $this->exam = $this->getExam($examId);
        $this->student = $this->getExaminee($request, $this->exam->id);
        $this->request = $request;

        if (!$this->student) {
            return "This test is not for your batch";
        }


        $checkExamDateValidation = $this->examDateValidation();

        if ($checkExamDateValidation !== 0) {
            return $checkExamDateValidation;
        }
        $questionPaper = $this->getQuestionPaper();
        return view('student.exam',compact('questionPaper'));
    }


    public function getQuestionPaper()
    {
        $isExamStarted = $this->isExamStarted();
        if ($isExamStarted) {
            $questions = $this->resumeExam();
        } else {
            $questions = $this->startExam();
        }

        return [
            'student_exam' => $this->studentExam,
            "student" => $this->student,
            "is_exam_started" => $isExamStarted,
            "questions" => $questions,
        ];
    }

    public function getExaminee(Request $request, $id)
    {
        return Student::where('exam_seat_no', $request->exam_seat_no)
            ->where('password', $request->password)
            ->where('batch', $id)
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


    public function examDateValidation()
    {
        $start_date = date('Y-m-d h:i:s', strtotime($this->exam->start_date));
        $end_date = date('Y-m-d h:i:s', strtotime($this->exam->end_date));

        $now = date(Carbon::now());

        if ($start_date > $now) {
            return "your exam is not started yet";
        }


        if ($end_date < $now) {
            return "your exam is completed";
        }
        return 0;
    }

    // public function checkExamStartedStatus(){
    //         return StudentExam::where('exams_id',$this->exam->id)
    //             ->where('student_id',$this->student->id)
    //             ->where('is_started','>',0)
    //             ->where('is_completed')
    //             ->exists();
    // }


    public function isExamStarted()
    {
        return StudentExam::where('exams_id', $this->exam->id)
            ->where('student_id', $this->student->id)
            ->where('is_started', 1)
            ->where('is_completed', 0)
            ->exists();
    }


    public function startExam()
    {
        $this->studentExam = new StudentExam();
        $this->studentExam->exams_id = $this->exam->id;
        $this->studentExam->student_id = $this->student->id;
        $this->studentExam->exam_seat_no = $this->student->exam_seat_no;
        $this->studentExam->is_started = true;
        $this->studentExam->is_completed = false;
        $this->studentExam->start_time = date(now());
        $this->studentExam->duration = $this->studentExam->time_remaining = $this->exam->duration;

        try {
            $this->studentExam->save();
            $questions = ExamQuestion::leftJoin('student_exam_answers', 'exam_questions.id','=', 'student_exam_answers.exam_questions_id')
            ->select(
                "exam_questions.question",
                "exam_questions.option_a",
                "exam_questions.option_b",
                "exam_questions.option_c",
                "exam_questions.option_d",
                "exam_questions.id",
                "exam_questions.exams_id",
                "student_exam_answers.answer as selected_answer"
            )
            ->where('exam_questions.exams_id', $this->exam->id)->get();

            return $questions;
        } catch (\Throwable $th) {
            throw new Exception("Oops..! something went wrong", 1);
        };
    }

    public function resumeExam()
    {
        try {
            $this->studentExam = StudentExam::where('student_id', $this->student->id)->first();

            if (!$this->studentExam) {
                throw new Exception('Exam not found', 1);
            }
        } catch (\Throwable $th) {
            throw new Exception("Oops..! something went wrong. " . $th->getMessage(), 1);
        };

        //return $this->studentExam;
        // $questions=ExamQuestion::where('exams_id', $this->exam->id)->get();

        $questions = ExamQuestion::leftJoin('student_exam_answers', 'exam_questions.id','=', 'student_exam_answers.exam_questions_id')
            ->select(
                "exam_questions.question",
                "exam_questions.option_a",
                "exam_questions.option_b",
                "exam_questions.option_c",
                "exam_questions.option_d",
                "exam_questions.id",
                "exam_questions.exams_id",
                "student_exam_answers.answer as selected_answer"
            )
            ->where('exam_questions.exams_id', $this->exam->id)->get();

        return $questions;
        // ExamQuestion::join('student_exam_anwsers','')
        // where('exams_id', $this->exam->id)->get()
    }
}
