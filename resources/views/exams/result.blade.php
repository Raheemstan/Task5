@extends('layouts.app')

@section('title', 'Exam Results')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4 justify-content-center">
        <div class="col-sm-12 col-md-8">
            <div class="bg-light rounded h-100 p-4 text-center">
                <h6 class="mb-4">Exam Results for: {{ $exam->name }}</h6>
                
                <div class="alert alert-info">
                    <h4>Total Score: {{ $result->total_score }}</h4>
                    <p>Correct Answers: {{ $result->correct_answers }}</p>
                    <p>Wrong Answers: {{ $result->wrong_answers }}</p>
                </div>
                
                <a href="{{ route('exams.login') }}" class="btn btn-primary">Return to Exam Login</a>
            </div>
        </div>
    </div>
</div>
@endsection
