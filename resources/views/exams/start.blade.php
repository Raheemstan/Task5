@extends('layouts.app')

@section('title', 'Take Exam')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-sm-12 col-md-8">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Exam: {{ $exam->name }}</h6>
                    <form action="{{ route('exams.submit', $exam->id) }}" method="POST">
                        @csrf
                        @foreach($exam->questions as $question)
                            <div class="mb-4">
                                <p><strong>{{ $loop->iteration }}. {{ $question->question }}</strong></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="A"
                                        required>
                                    <label class="form-check-label">A: {{ $question->option_a }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="B"
                                        required>
                                    <label class="form-check-label">B: {{ $question->option_b }}</label>
                                </div>
                                @if($question->option_c)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="C">
                                        <label class="form-check-label">C: {{ $question->option_c }}</label>
                                    </div>
                                @endif
                                @if($question->option_d)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="D">
                                        <label class="form-check-label">D: {{ $question->option_d }}</label>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-success">Submit Exam</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection