<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasUlids;
    protected $fillable = [
        'name',
        'subject',
        'min_grade',
        'exam_date',
    ];

    public function questions()
    {
        return $this->hasMany(Questions::class);
    }
}
