<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResults extends Model
{
    protected $fillable = [
        'student_id',
        'exams_id',
        'total_score',
        'grade',
        'passing_score',
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

    /**
     * Determine if the student passed or failed
     */
    public function isPassed()
    {
        return $this->total_score >= $this->passing_score;
    }

    /**
     * Assign grade based on school-defined criteria
     */
    public function assignGrade($gradingScale)
    {
        foreach ($gradingScale as $grade => $minScore) {
            if ($this->total_score >= $minScore) {
                $this->update(['grade' => $grade, 'status' => 'passed']);
                return;
            }
        }

        $this->update(['grade' => 'F', 'status' => 'failed']);
    }
}
