<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\ExamQuestion;
use App\Http\Controllers\Controller;
use App\Student;
use App\StudentExam;
use App\StudentExamAnswer;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

use function PHPUnit\Framework\throwException;

class ExamController extends Controller
{
    private $exam, $student, $request, $studentExam;
    public function startExamView($examId)
    {
        try {
            $this->exam = $this->getExam($examId);
        } catch (\Throwable $th) {
            $message="Invalid Exam.!";
            return view('student.message',compact('message'));
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
            $message = "This test is not for your batch";
            return view('student.message', compact('message'));
        }


        $this->getStudentExam();


        //return $this->studentExam;



        if ($this->studentExam->time_remaining < 0 || $this->studentExam->is_completed) {
            $message = "Test is already submitted";
            $result=ResultController::generateResult($this->studentExam);

            return view('student.message', compact('message','result'));
        }

       $this->isExamStarted();
       $checkExamDateValidation = $this->examDateValidation();

        if ($checkExamDateValidation !== 0) {
            return $checkExamDateValidation;
        }
        $questionPaper = $this->getQuestionPaper();
        return view('student.exam', compact('questionPaper'));
    }


    public function getQuestionPaper()
    {

        $isExamStarted = $this->isExamStarted();
        if ($isExamStarted) {
            $questions = $this->resumeExam();
        } else {
            $questions = $this->startExam();
        }
        $isExamStarted = $this->isExamStarted();

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


    public function getStudentExam()
    {
       if ($this->isExamStarted()) {
            try {
                $this->studentExam = StudentExam::where('student_id', $this->student->id)->first();
                // if (!$this->studentExam) {
                //     throw new Exception('Exam not found', 1);
                // }
            } catch (\Throwable $th) {
                throw new Exception("Oops..! something went wrong. " . $th->getMessage(), 1);
            };

        } else {
            $this->studentExam = new StudentExam();
        }

    }


    public function examDateValidation()
    {
        $start_date = date('Y-m-d h:i:s', strtotime($this->exam->start_date));
        $end_date = date('Y-m-d h:i:s', strtotime($this->exam->end_date));

        $now = date(Carbon::now());

        if ($start_date > $now) {

            $message = "your exam is not started yet";
            return view('student.message', compact('message'));
        }


        if ($end_date < $now) {
            $message = "your exam  is completed";
            return view('student.message', compact('message'));
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
            //->where('is_completed', '!=' ,1)
            //->where('time_remaining','>',0)
            ->exists();
    }


    public function startExam()
    {
        //$this->studentExam = new StudentExam();
        $this->studentExam->exams_id = $this->exam->id;
        $this->studentExam->student_id = $this->student->id;
        $this->studentExam->exam_seat_no = $this->student->exam_seat_no;
        $this->studentExam->is_started = true;
        $this->studentExam->is_completed = 0;
        $this->studentExam->start_time = date(now());
        $this->studentExam->duration = $this->studentExam->time_remaining = $this->exam->duration;



        try {
            $this->studentExam->save();
            $studentExamQuestions = ExamQuestion::where('exams_id', $this->exam->id)->get();
            foreach ($studentExamQuestions as $key => $studentExamQuestion) {
                $studentExamAnswer = new StudentExamAnswer();
                $studentExamAnswer->student_exams_id = $this->studentExam->id;
                $studentExamAnswer->exam_questions_id = $studentExamQuestion->id;
                $studentExamAnswer->save();
            }

            $questions = ExamQuestion::leftJoin('student_exam_answers', 'exam_questions.id', '=', 'student_exam_answers.exam_questions_id')
                ->select(
                    "exam_questions.question",
                    "exam_questions.option_a",
                    "exam_questions.option_b",
                    "exam_questions.option_c",
                    "exam_questions.option_d",
                    "exam_questions.id",
                    "exam_questions.exams_id",
                    "student_exam_answers.answer as selected_answer",
                    "student_exam_answers.student_exams_id"
                )
                ->where('exam_questions.exams_id', $this->exam->id)
                ->where('student_exam_answers.student_exams_id', $this->studentExam->id)
                ->get();
            return $questions;
        } catch (\Throwable $th) {
            throw new Exception("Exception : " . $th->getMessage(), 1);
        };
    }


    public function resumeExam()
    {
        try {

            if (!$this->studentExam) {
                throw new Exception('Exam not found', 1);
            }
        } catch (\Throwable $th) {
            throw new Exception("Oops..! something went wrong. " . $th->getMessage(), 1);
        };



        return $questions = ExamQuestion::leftJoin('student_exam_answers', 'exam_questions.id', '=', 'student_exam_answers.exam_questions_id')
            ->select(
                "exam_questions.question",
                "exam_questions.option_a",
                "exam_questions.option_b",
                "exam_questions.option_c",
                "exam_questions.option_d",
                "exam_questions.id",
                "exam_questions.exams_id",
                "student_exam_answers.answer as selected_answer",
                "student_exam_answers.student_exams_id"
            )
            ->where('exam_questions.exams_id', $this->exam->id)
            ->where('student_exam_answers.student_exams_id', $this->studentExam->id)
            ->get();
        return $questions->where('student_exams_id', $this->studentExam->id);
    }



}
