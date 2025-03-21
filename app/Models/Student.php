<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasUlids, HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'class',
        'requires_remedial',
    ];

    protected $casts = [
        'requires_remedial' => 'boolean',
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