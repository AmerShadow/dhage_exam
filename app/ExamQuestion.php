<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{


    public function exam()
    {
        return $this->belongsTo('App\Exam','exams_id','id');
    }
}
