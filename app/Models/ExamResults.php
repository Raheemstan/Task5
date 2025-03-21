<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResults extends Model
{
    protected $fillable = [
        'student_id',
        'exams_id',
        'total_score',
        'is_remidial',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exams::class);
    }
}
