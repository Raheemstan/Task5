<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'exams_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'score',
        'answer',
        'status',
    ];

    public function exams()
    {
        return $this->belongsTo(Exams::class);
    }
}
