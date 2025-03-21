@extends('layouts.app')

@section('title', 'Manage Questions')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Manage Questions for Exam: {{ $exam->name }}</h6>

                    <a href="{{ route('questions.create', $exam->id) }}" class="btn btn-primary mb-3">Add New Question</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th>Answer</th>
                                <th>Marks</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>{{ $question->id }}</td>
                                    <td>{{ $question->question }}</td>
                                    <td>
                                        A: {{ $question->option_a }}<br>
                                        B: {{ $question->option_b }}<br>
                                        @if($question->option_c) C: {{ $question->option_c }}<br> @endif
                                        @if($question->option_d) D: {{ $question->option_d }} @endif
                                    </td>
                                    <td>{{ $question->answer }}</td>
                                    <td>{{ $question->score }}</td>
                                    <td>
                                        <form action="{{ route('questions.status', $question->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit"
                                                class="btn btn-sm {{ $question->status == 'active' ? 'btn-success' : 'btn-secondary' }}">
                                                {{ ucfirst($question->status) }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editQuestionModal{{ $question->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $question->id }})">Delete</button>
                                        <form id="delete-form-{{ $question->id }}"
                                            action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1"
                                    aria-labelledby="editQuestionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('questions.update', $question->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="mb-3">
                                                        <label for="question" class="form-label">Question</label>
                                                        <textarea class="form-control" name="question"
                                                            required>{{ $question->question }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="option_a" class="form-label">Option A</label>
                                                        <input type="text" class="form-control" name="option_a"
                                                            value="{{ $question->option_a }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="option_b" class="form-label">Option B</label>
                                                        <input type="text" class="form-control" name="option_b"
                                                            value="{{ $question->option_b }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="option_c" class="form-label">Option C</label>
                                                        <input type="text" class="form-control" name="option_c"
                                                            value="{{ $question->option_c }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="option_d" class="form-label">Option D</label>
                                                        <input type="text" class="form-control" name="option_d"
                                                            value="{{ $question->option_d }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="answer" class="form-label">Correct Answer</label>
                                                        <input type="text" class="form-control" name="answer"
                                                            value="{{ $question->answer }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="score" class="form-label">Marks</label>
                                                        <input type="number" class="form-control" name="score"
                                                            value="{{ $question->score }}" required>
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
        function confirmDelete(questionId) {
            if (confirm('Are you sure you want to delete this question?')) {
                try {
                    console.log('Deleting question with ID:', questionId);
                    document.getElementById('delete-form-' + questionId).submit();
                } catch (error) {
                    console.error('Error deleting question:', error);
                    alert('An error occurred while deleting the question. Please try again.');
                }
            }
        }
    </script>
@endsection