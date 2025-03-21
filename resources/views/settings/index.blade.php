@extends('layouts.app')

@section('title', 'Exam Settings')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4 justify-content-center">
        <div class="col-sm-12 col-md-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Exam Settings</h6>
                
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="passing_score" class="form-label">Passing Score (%)</label>
                        <input type="number" class="form-control" name="passing_score" value="{{ $settings->passing_score ?? 50 }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="exam_time_limit" class="form-label">Exam Time Limit (Minutes)</label>
                        <input type="number" class="form-control" name="exam_time_limit" value="{{ $settings->exam_time_limit ?? 60 }}" required>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="exam_enabled" id="exam_enabled" {{ $settings->exam_enabled ? 'checked' : '' }}>
                        <label class="form-check-label" for="exam_enabled">Enable Exams</label>
                    </div>
                    <h6 class="mt-4">Grading System</h6>
                    @php
                        $gradingSystem = $settings->grading_system ? json_decode($settings->grading_system, true) : ['A' => 90, 'B' => 80, 'C' => 70, 'D' => 60, 'F' => 0];
                    @endphp
                    <div class="row">
                        @foreach($gradingSystem as $grade => $score)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Grade {{ $grade }} Minimum Score</label>
                                    <input type="number" class="form-control" name="grading_system[{{ $grade }}]" value="{{ $score }}" required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection