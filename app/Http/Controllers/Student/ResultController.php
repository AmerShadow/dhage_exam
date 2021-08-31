<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\ExamQuestion;
use App\Http\Controllers\Controller;
use App\StudentExam;
use App\StudentExamAnswer;
use Illuminate\Http\Request;


class ResultController extends Controller
{
    public static function generateResult(StudentExam $studentExam)
    {
        $examQuestions = ExamQuestion::where('exams_id', $studentExam->exams_id)->get();
        $examQuestionsCount = $examQuestions->count();
        $examQuestionsArray = $examQuestions->pluck('id');
        $studentAnswers = StudentExamAnswer::join('exam_questions', 'student_exam_answers.exam_questions_id', 'exam_questions.id')
            ->select(
                'exam_questions.question',
                'exam_questions.answer',
                'exam_questions.option_a',
                'exam_questions.option_b',
                'exam_questions.option_c',
                'exam_questions.option_d',
                'student_exam_answers.answer as student_selected_answer'
            )
            ->where('student_exam_answers.student_exams_id', $studentExam->id)
            ->whereIn('student_exam_answers.exam_questions_id', $examQuestionsArray)
            ->get();

        $marks=0;
        foreach ($studentAnswers   as $key => $stdentAnswer) {
            if ($stdentAnswer->answer == "A" && $stdentAnswer->student_selected_answer ==1) {
                $marks++;
            }
            if ($stdentAnswer->answer == "B" && $stdentAnswer->student_selected_answer ==2) {
                $marks++;
            }
            if ($stdentAnswer->answer == "C" && $stdentAnswer->student_selected_answer ==3) {
                $marks++;
            }
            if ($stdentAnswer->answer == "D" && $stdentAnswer->student_selected_answer ==4) {
                $marks++;
            }
        }

        $totalMarks=$examQuestionsArray->count();

        $passingCriteria=env('Passing_criteria', 'production');
        $status = $marks/$totalMarks*100 > $passingCriteria ? "Pass":"Fail";

        $studentExam->marks=$marks;
        $studentExam->result=$status;
        $studentExam->update();
        return [
            "status" => $status,
            "marks" => $marks,
            'totalMarks' =>$totalMarks,
            'studentAnswers' => $studentAnswers,
        ];
    }
}
