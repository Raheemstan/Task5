@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4 justify-content-center">
            <div class="col-sm-12 col-md-8">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Register New Student</h6>

                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="class" class="form-label">Class</label>
                            <select class="form-control" name="class" required>
                                @foreach(App\Models\Student::getClasses() as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Register Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection