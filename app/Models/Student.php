<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasUlids, HasFactory;
    protected $fillable = [
        'name',
        'email',
        'class',
    ];

    public function examResults()
    {
        return $this->hasMany(ExamResults::class);
    }


    public static function getClasses()
    {
        return [
            'JSS1' => 'JSS1',
            'JSS2' => 'JSS2',
            'JSS3' => 'JSS3',
            'SS1' => 'SS1',
            'SS2' => 'SS2',
            'SS3' => 'SS3',
        ];
    }
}
