<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamQuestion;
use App\Student;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Question\Question;

class ExamController extends Controller
{

    public function index()
    {
        $exams=Exam::all();
       // return $exams;
        return view('exams.index',compact('exams'));
    }




    function createExam()
    {
        $baseUrl = env('BASE_URL');
        $url = $baseUrl . '/branches';
        try {
            $response = Http::get($url);
        } catch (\Throwable $th) {
            print("Unable to get branches");
            return redirect()->route('admin.exam.create')->with('unsuccess', 'Unable to get branches');
        }
        $data = $response->json();
        if ($data['status'] == "S") {
            $branches = $data["data"];
            return view('exams.create', compact('branches'));
        } else {
            return "no";
        }
    }

    public function storeExam(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'duration' => 'required|nullable',
            'start_date' => 'required',
            'end_date' => 'required',
            'branch' => 'required|string',
            'year' => 'required|numeric',
        ]);

        $exam = new Exam();

        $exam->name = $request->name;
        $exam->duration = $request->duration;
        $exam->start_date = $request->start_date;
        $exam->end_date = $request->end_date;
        $exam->branch = $request->branch;
        $exam->year = $request->year;
        $exam->status = 1;




        do {
            $batch=date('Y').$request->branch.$request->year.rand($min=1000,$max=9999);
        } while (Exam::where('batch',$batch)->exists());


        $exam->batch = $batch;
        if ($exam->save()) {
            $url = env('BASE_URL') . '/students/' . $request->branch . '/' . $request->year;
            $response = Http::get($url);

            if ($response["status"] == "S") {
                $data = $response->json();

                if ($data['status'] == "S") {
                    $students = $data['data'];
                    foreach ($students as $key => $student) {

                        $examinee = new Student();
                        $examinee->name = $student["name"];

                        $examinee->exam_seat_no="IV".$exam->batch.str_pad($key+1, 6, '0', STR_PAD_LEFT);
                        $examinee->email = $student["email"];
                        $examinee->mobile = $student["phone"];
                        $examinee->password = rand($min= 11111111,$max=99999999);
                        $examinee->batch = $exam->id;
                        $examinee->branch = $student["branch"];
                        $examinee->year = $student["year"];
                        $examinee->dob="";
                        $examinee->save();
                    }
                    return redirect()->route('admin.exam.index')->with('success','Exam Added seccessfully');

                }
            } else {
                $exam->delete();

                return 'Unable to fetch data';
                return redirect()->back()->with('unsuccess', 'Unable to fetch data from server');
            }
        } else {
            return " Unable to create exam";
            return redirect()->back()->with('unsuccess', 'Oops..! Unable to create exam');
        }
    }


    //set paper
    public function setPaper(Exam $exam)
    {
        $questions=$exam->questions;


        $baseUrl = env('BASE_URL');
        $url = $baseUrl . '/questions';
        try {
            $response = Http::get($url);
        } catch (\Throwable $th) {
            print("Unable to get branches");
            return redirect()->route('admin.exam.index')->with('unsuccess', 'Unable to get questions');
        }
        $data = $response->json();
        if ($data['status'] == "S") {
            $importedQuestions = $data["data"];
            //return $questions;
            return view('paper.set', compact('questions','exam','importedQuestions'));
        } else {
            return redirect()->route('admin.exam.index')->with('unsuccess', 'Unable to get branches');

            return "no";
        }

        return view('paper.set',compact('exam','questions'));
    }


    //Add question to In a question paper for exam
    public function addQuestion(Request $request,$id)
    {
        $request->validate([
            'question'=> 'required',
            'answer'=> 'required',
            'option_a'=> 'required',
            'option_b'=> 'required',
            'option_c'=> 'required',
            'option_d'=> 'required',
        ]);

        try {
            $exam=Exam::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'F',
                'message' => 'Exam not Found',

            ]);
        }

        $examQuestion=new ExamQuestion();
        $examQuestion->exams_id=$id;
        $examQuestion->question=$request->question;
        $examQuestion->option_a=$request->option_a;
        $examQuestion->option_b=$request->option_b;
        $examQuestion->option_c=$request->option_c;
        $examQuestion->option_d=$request->option_d;
        $examQuestion->answer=$request->answer;


        if ($examQuestion->save()) {
            return response()->json([
                'status' => 'S',
                'message' => 'Question Added successfully',
                'data' => $examQuestion,
            ]);
        } else {
            return response()->json([
                'status' => 'F',
                'message' => 'Unable to add Question',
            ]);
        }
    }


    public function deleteQuestion($id)
    {
        try {
            $question=ExamQuestion::findOrFail($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('unsuccess','question not found');
        }

        $deletedQuestionId=$question->id;

        if ($question->delete()) {
            return redirect()->back()->with('success','question Deleted Successfully');

        } else {
            return redirect()->back()->with('unsuccess','Unable to delete Question');
        }
    }
}
