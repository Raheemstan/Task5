@extends('layouts.app')

@section('title', 'Create Exam')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-8">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Create New Exam</h6>
                    <form action="{{ route('exams.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exam_name" class="form-label">Exam Name</label>
                            <input type="text" class="form-control" id="exam_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_grade" class="form-label">Minimum Grade</label>
                            <input type="number" class="form-control" id="min_grade" name="min_grade" required>
                        </div>
                        <div class="mb-3">
                            <label for="exam_date" class="form-label">Exam Date</label>
                            <input type="date" class="form-control" id="exam_date" name="exam_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Exam</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection