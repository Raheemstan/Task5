@extends('layouts.app')

@section('title', 'Exam Result')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-sm-12 col-md-8">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Exam Result</h6>

                    <p><strong>Student Name:</strong> {{ $student->name }}</p>
                    <p><strong>Exam:</strong> {{ $exam->name }}</p>
                    <p><strong>Total Score:</strong> {{ $examResult->total_score }} / {{ $examResult->passing_score }}</p>
                    <p><strong>Grade:</strong> <span class="badge bg-primary">{{ $examResult->grade }}</span></p>
                    
                    @if ($examResult->status === 'passed')
                        <p class="text-success"><strong>Status: Passed 🎉</strong></p>
                    @else
                        <p class="text-danger"><strong>Status: Failed ❌</strong></p>
                    @endif

                    <hr>

                    <h6 class="mb-3">Question Breakdown:</h6>
                    <ul class="list-group">
                        @foreach ($questions as $question)
                            <li class="list-group-item">
                                <p><strong>Q:</strong> {{ $question->question }}</p>
                                <p>
                                    <strong>Your Answer:</strong> 
                                    <span class="{{ $question->is_correct ? 'text-success' : 'text-danger' }}">
                                        {{ $question->student_answer }}
                                    </span>
                                </p>
                                <p><strong>Correct Answer:</strong> {{ $question->answer }}</p>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
