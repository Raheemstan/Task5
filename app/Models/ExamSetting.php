<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSetting extends Model
{
    use HasFactory;

    protected $table = 'exam_settings';

    protected $fillable = [
        'passing_score',
        'exam_time_limit',
        'grading_system',
        'status',
    ];

    protected $casts = [
        'grading_system' => 'array', 
    ];

    public static function getGradingScale()
    {
        $settings = self::first();
        return $settings ? $settings->grading_system : [
            'A' => 90,
            'B' => 80,
            'C' => 70,
            'D' => 60,
            'F' => 0,
        ];
    }
}
