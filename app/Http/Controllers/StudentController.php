<?php

namespace App\Http\Controllers;

use App\Models\ExamResults;
use Exception;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Notifications\RemedialNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'class' => 'required|string|max:6',
            ]);

            Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'class' => $request->class, 
            ]);

            Log::info('New student registered: ' . $request->email);
            return redirect()->route('students.index')->with('success', 'Student registered successfully!');
        } catch (Exception $e) {
            Log::error('Failed to register student: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while registering the student.');
        }
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email,' . $student->id,
                'class' => 'required|string|max:6',
            ]);

            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'class' => $request->class,
            ]);

            Log::info('Student updated: ' . $student->email);
            return redirect()->route('students.index')->with('success', 'Student updated successfully!');
        } catch (Exception $e) {
            Log::error('Failed to update student: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the student.');
        }
    }

    public function destroy(Student $student)
    {
        try {
            $student->delete();
            Log::info('Student deleted: ' . $student->email);
            return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
        } catch (Exception $e) {
            Log::error('Failed to delete student: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the student.');
        }
    }
    public function checkRemedialFlag()
    {
        $students = Student::all();
        foreach ($students as $student) {
            $failedSubjects = ExamResults::where('student_email', $student->email)
                ->where('total_score', '<', config('settings.passing_score', 50))
                ->count();
            
            if ($failedSubjects > 2) {
                $student->update(['requires_remedial' => true]);
                
                // Send notification
                Notification::send($student, new RemedialNotification());
                Log::info('Student flagged for remedial: ' . $student->email);
            } else {
                $student->update(['requires_remedial' => false]);
            }
        }
        return redirect()->route('students.index')->with('success', 'Remedial checks updated successfully!');
    }
}