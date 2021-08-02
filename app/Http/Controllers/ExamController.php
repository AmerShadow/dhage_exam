<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Student;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{

    function createExam()
    {
        $baseUrl = env('BASE_URL');
        $url = $baseUrl . '/branches';
        try {
            $response = Http::get($url);
        } catch (\Throwable $th) {
            print("Unable to get branches");
            return redirect()->route('exam.create')->with('unsuccess', 'Unable to get branches');
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
        $exam->batch = $request->branch."".$request->year;
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
                        $examinee->exam_seat_no="IV".date('Y')."".$exam->batch."".str_pad($key+1, 6, '0', STR_PAD_LEFT);
                        $examinee->email = $student["email"];
                        $examinee->mobile = $student["phone"];
                        $examinee->password = rand($min= 11111111,$max=99999999);
                        $examinee->branch = $student["branch"];
                        $examinee->year = $student["year"];
                        $examinee->dob="";

                        $examinee->save();


                    }
                    return 'success';

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
}
