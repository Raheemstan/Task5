@extends('layouts.app')

@section('title', 'Manage Students')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Manage Students</h6>

                    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add New Student</a>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Class</th>
                                <th>Remidial  Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->class }}</td>
                                    <td>
                                        @if($student->requires_remedial)
                                            <span class="badge bg-danger">Requires Remedial</span>
                                        @else
                                            <span class="badge bg-success">Passed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editStudentModal{{ $student->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $student->id }})">Delete</button>
                                        <form id="delete-form-{{ $student->id }}"
                                            action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1"
                                    aria-labelledby="editStudentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('students.update', $student->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $student->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ $student->email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="class" class="form-label">Class</label>
                                                        <select class="form-control" name="class" required>
                                                            @foreach(App\Models\Student::getClasses() as $key => $value)
                                                                <option value="{{ $key }}" {{ $student->class == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $students->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(studentId) {
            if (confirm('Are you sure you want to delete this student?')) {
                try {
                    document.getElementById('delete-form-' + studentId).submit();
                } catch (error) {
                    alert('An error occurred while deleting the student. Please try again.');
                }
            }
        }
    </script>
@endsection