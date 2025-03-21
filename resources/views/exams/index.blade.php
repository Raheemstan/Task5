@extends('layouts.app')

@section('title', 'Manage Exams')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Manage Exams</h6>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Minimum Grade</th>
                            <th>Exam Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exams as $exam)
                        <tr>
                            <td>{{ $exam->id }}</td>
                            <td>{{ $exam->name }}</td>
                            <td>{{ $exam->subject }}</td>
                            <td>{{ $exam->min_grade }}</td>
                            <td>{{ $exam->exam_date }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editExamModal{{ $exam->id }}">Edit</button>
                                <a href="{{ route('questions.index', $exam->id) }}" class="btn btn-primary btn-sm">Questions</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $exam->id }})">Delete</button>
                                <form id="delete-form-{{ $exam->id }}" action="{{ route('exams.destroy', $exam->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editExamModal{{ $exam->id }}" tabindex="-1" aria-labelledby="editExamModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editExamModalLabel">Edit Exam</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('exams.update', $exam->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Exam Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ $exam->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="subject" class="form-label">Subject</label>
                                                <input type="text" class="form-control" name="subject" value="{{ $exam->subject }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="min_grade" class="form-label">Minimum Grade</label>
                                                <input type="number" class="form-control" name="min_grade" value="{{ $exam->min_grade }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exam_date" class="form-label">Exam Date</label>
                                                <input type="date" class="form-control" name="exam_date" value="{{ $exam->exam_date }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(examId) {
        if (confirm('Are you sure you want to delete this exam?')) {
            try {
                document.getElementById('delete-form-' + examId).submit();
            } catch (error) {
                alert('An error occurred while deleting the exam. Please try again.');
            }
        }
    }
</script>
@endsection
