<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Exams;
use Illuminate\Support\Facades\Log;
use Exception;

class QuestionsController extends Controller
{
    public function index(Exams $exam)
    {
        $questions = $exam->questions()->get();
        if ($questions->isEmpty()) {
            return view('questions.index', ['questions' => [], 'exam' => $exam, 'message' => 'No questions found for this exam.']);
        }
        return view('questions.index', compact('questions', 'exam'));
    }

    public function create(Exams $exam)
    {
        return view('questions.create', compact('exam'));
    }

    public function store(Request $request, Exams $exam)
    {
        try {
            $request->validate([
                'question' => 'required|string',
                'option_a' => 'required|string|max:255',
                'option_b' => 'required|string|max:255',
                'option_c' => 'nullable|string|max:255',
                'option_d' => 'nullable|string|max:255',
                'answer' => 'required|in:A,B,C,D',
                'score' => 'required|integer|min:1',
            ]);

            $exam->questions()->create([
                'question' => $request->question,
                'option_a' => $request->option_a,
                'option_b' => $request->option_b,
                'option_c' => $request->option_c,
                'option_d' => $request->option_d,
                'answer' => $request->answer,
                'score' => $request->score,
            ]);

            Log::info('Question added successfully for exam ID: ' . $exam->id);
            return redirect()->route('questions.index', $exam->id)->with('success', 'Question added successfully!');
        } catch (Exception $e) {
            Log::error('Failed to add question: ' . $e->getMessage());
            return back()->with('error', 'Failed to add question: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Questions $question)
    {
        try {
            $request->validate([
                'question' => 'required|string',
                'option_a' => 'required|string|max:255',
                'option_b' => 'required|string|max:255',
                'option_c' => 'nullable|string|max:255',
                'option_d' => 'nullable|string|max:255',
                'answer' => 'required|in:A,B,C,D',
                'score' => 'required|integer|min:1',
            ]);

            $question->update([
                'question' => $request->question,
                'option_a' => $request->option_a,
                'option_b' => $request->option_b,
                'option_c' => $request->option_c,
                'option_d' => $request->option_d,
                'answer' => $request->answer,
                'score' => $request->score,
            ]);

            Log::info('Question updated successfully for question ID: ' . $question->id);
            return back()->with('success', 'Question updated successfully!');
        } catch (Exception $e) {
            Log::error('Failed to update question: ' . $e->getMessage());
            return back()->with('error', 'Failed to update question: ' . $e->getMessage());
        }
    }

    public function destroy(Questions $question)
    {
        try {
            $question->delete();
            Log::info('Question deleted successfully for question ID: ' . $question->id);
            return back()->with('success', 'Question deleted successfully!');
        } catch (Exception $e) {
            Log::error('Failed to delete question: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete question: ' . $e->getMessage());
        }
    }

    public function status(Questions $question)
    {
        try {
            $status = $question->status === 'active' ? 'inactive' : 'active';
            $question->update(['status' => $status]);
            Log::info('Question status updated successfully for question ID: ' . $question->id);
            return back()->with('success', 'Question status updated successfully!');
        } catch (Exception $e) {
            Log::error('Failed to update question status: ' . $e->getMessage());
            return back()->with('error', 'Failed to update question status: ' . $e->getMessage());
        }
    }
}
