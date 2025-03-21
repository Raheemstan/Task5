<?php

namespace App\Http\Controllers;

use App\Models\ExamResults;
use App\Models\Exams;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ExamsController extends Controller
{
    public function index()
    {
        $exams = Exams::all();
        return view('exams.index', compact('exams'));
    }

    public function create()
    {
        return view('exams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'min_grade' => 'required|numeric|min:0',
            'exam_date' => 'required|date',
        ]);

        try {
            Exams::create([
                'name' => $request->name,
                'subject' => $request->subject,
                'min_grade' => $request->min_grade,
                'exam_date' => $request->exam_date,
            ]);

            Log::info('Exam created successfully');
            return redirect()->route('exams.index')->with('success', 'Exam created successfully!');
        } catch (Exception $e) {
            Log::error('Error creating exam: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create exam.');
        }
    }

    public function show(Exams $exam)
    {
        return view('exams.show', compact('exam'));
    }

    public function edit(Exams $exam)
    {
        return view('exams.edit', compact('exam'));
    }

    public function update(Request $request, Exams $exam)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'min_grade' => 'required|numeric|min:0',
            'exam_date' => 'required|date',
        ]);

        try {
            $exam->update([
                'name' => $request->name,
                'subject' => $request->subject,
                'min_grade' => $request->min_grade,
                'exam_date' => $request->exam_date,
            ]);

            Log::info('Exam updated successfully');
            return redirect()->back()->with('success', 'Exam updated successfully!');
        } catch (Exception $e) {
            Log::error('Error updating exam: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update exam.');
        }
    }

    public function destroy(Exams $exam)
    {
        try {
            $exam->delete();
            return redirect()->back()->with('success', 'Exam deleted successfully!');
        } catch (Exception $e) {
            Log::error('Error deleting exam: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete exam.');
        }
    }

    public function showLogin()
    {
        return view('exams.login');
    }
    public function authenticate(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:students,email',
                'exam_id' => 'required|exists:exams,id'
            ]);

            $exam = Exams::find($request->exam_id);
            $student = Student::where('email', $request->email)->first();

            if (!$exam) {
                Log::warning('Invalid Exam ID entered: ' . $request->exam_id);
                return back()->with('error', 'Invalid Exam ID.');
            }

            if (!$student) {
                Log::warning('Unauthorized email attempted: ' . $request->email);
                return back()->with('error', 'Unauthorized access.');
            }

            // Check if the student has already taken the exam
            $existingResult = ExamResults::where('student_id', $student->id)
                ->where('exams_id', $exam->id)
                ->first();

            if ($existingResult) {
                return redirect()->route('exams.result', $exam->id)->with('error', 'You have already taken this exam.');
            }

            // Store student info in session
            Session::put('student_email', $request->email);
            Session::put('student_id', $student->id);
            Session::put('exam_id', $exam->id);

            Log::info('Student ' . $student->email . ' accessed Exam ID: ' . $exam->id);

            return redirect()->route('exams.start', $exam->id);
        } catch (Exception $e) {
            Log::error('Exam authentication failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred. Please try again.');
        }
    }

    public function startExam(Exams $exam)
    {
        if (!Session::has('student_email') || Session::get('exam_id') != $exam->id) {
            Log::warning('Unauthorized access attempt to exam ID: ' . $exam->id);
            return redirect()->route('exams.login')->with('error', 'Unauthorized access.');
        }

        Log::info('Student ' . Session::get('student_email') . ' started Exam ID: ' . $exam->id);
        return view('exams.start', compact('exam'));
    }

    public function submitExam(Request $request, Exams $exam)
    {
        try {
            if (!Session::has('student_email') || Session::get('exam_id') != $exam->id) {
                Log::warning('Unauthorized exam submission attempt for Exam ID: ' . $exam->id);
                return redirect()->route('exams.login')->with('error', 'Unauthorized access.');
            }

            $studentEmail = Session::get('student_email');
            $answers = $request->input('answers', []);
            $totalScore = 0;
            $correctAnswers = 0;
            $wrongAnswers = 0;

            foreach ($exam->questions as $question) {
                $studentAnswer = $answers[$question->id] ?? null;
                $isCorrect = $studentAnswer === $question->answer;

                if ($isCorrect) {
                    $totalScore += $question->score;
                    $correctAnswers++;
                } else {
                    $wrongAnswers++;
                }
            }

            ExamResults::create([
                'student_email' => $studentEmail,
                'exams_id' => $exam->id,
                'total_score' => $totalScore,
                // 'correct_answers' => $correctAnswers,
                // 'wrong_answers' => $wrongAnswers,
                // 'is_remedial' => $is_remedial,
                // 'status' => $is_remedial ? 'failed' : 'passed',
            ]);

            Log::info('Exam submitted successfully by ' . $studentEmail . ' for Exam ID: ' . $exam->id);
            return redirect()->route('exams.result', $exam->id)->with('success', 'Exam submitted successfully!');
        } catch (Exception $e) {
            Log::error('Failed to submit exam: ' . $e->getMessage());
            return back()->with('error', 'An error occurred. Please try again.');
        }
    }

    public function showResult(Exams $exam)
    {
        if (!Session::has('student_email') || Session::get('exam_id') != $exam->id) {
            Log::warning('Unauthorized attempt to view results for Exam ID: ' . $exam->id);
            return redirect()->route('exams.login')->with('error', 'Unauthorized access.');
        }

        $email = Session::get('student_email');
        $studentId = Student::where('email', $email)->first()->id;
        $result = ExamResults::where('student_id', $studentId)
            ->where('exams_id', $exam->id)
            ->first();
        if (!$result) {
            return redirect()->route('exams.login')->with('error', 'No result found.');
        }

        return view('exams.result', compact('exam', 'result'));
    }
}

