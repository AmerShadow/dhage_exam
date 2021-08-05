<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    //The following relationship returns all the question of an exam
    //call as $exam->questions;
    public function questions()
    {
        return $this->hasMany('App\ExamQuestion','exams_id','id');
    }
}
