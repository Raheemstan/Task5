<?php

namespace App\Services;

use App\Models\Student;
use App\Models\ExamResults;
use App\Notifications\RemedialNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class RemedialService
{
    /**
     * Check if a studen\t needs remedial classes and update their status.
     */
    public function checkAndUpdateRemedialStatus(Student $student)
    {
        $failedSubjects = ExamResults::where('student_id', $student->id)
            ->whereColumn('total_score', '<', 'passing_score')
            ->count();

        $requiresRemedial = $failedSubjects > 1;

        // Update student status only if it has changed
        if ($student->requires_remedial !== $requiresRemedial) {
            $student->update(['requires_remedial' => $requiresRemedial]);

            if ($requiresRemedial) {
                // Send notification to student
                Log::info('Sending remedial notification to ' . $student->email);
                Notification::send($student, new RemedialNotification());
            }
        }
    }
}
