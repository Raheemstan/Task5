@extends('layouts.app')

@section('title', 'Exam Login')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Student Exam Login</h6>
                
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                
                    <form action="{{ route('exams.authenticate') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Student Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="exam_id" class="form-label">Exam ID</label>
                            <input type="text" class="form-control" name="exam_id" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Start Exam</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection