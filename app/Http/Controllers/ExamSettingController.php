<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\ExamSetting;
use Illuminate\Support\Facades\Log;

class ExamSettingController extends Controller
{
    public function index()
    {
        $settings = ExamSetting::first();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'passing_score' => 'required|integer|min:1|max:100',
                'exam_time_limit' => 'required|integer|min:1',
                'exam_enabled' => 'nullable|boolean',
            ]);

            $settings = ExamSetting::firstOrCreate([]);
            $settings->update([
                'passing_score' => $request->passing_score,
                'exam_time_limit' => $request->exam_time_limit,
                'exam_enabled' => $request->has('exam_enabled'),
            ]);

            Log::info('Exam settings updated successfully');
            return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
        } catch (Exception $e) {
            Log::error('Failed to update settings: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating settings.');
        }
    }
}
