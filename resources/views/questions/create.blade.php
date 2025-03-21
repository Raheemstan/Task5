@extends('layouts.app')

@section('title', 'Add Question')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Add New Question for Exam: {{ $exam->name }}</h6>
                
                <form action="{{ route('questions.store', $exam->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <textarea class="form-control" name="question" required></textarea>
                    <div class="mb-3">
                        <label class="form-label">Options</label>
                        <input type="text" class="form-control mb-2" name="option_a" placeholder="Option A" required>
                        <input type="text" class="form-control mb-2" name="option_b" placeholder="Option B" required>
                        <input type="text" class="form-control mb-2" name="option_c" placeholder="Option C (Optional)">
                        <input type="text" class="form-control mb-2" name="option_d" placeholder="Option D (Optional)">
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Correct Answer</label>
                        <select class="form-select" name="answer" required>
                            <option value="" disabled selected>Select the correct answer</option>
                            <option value="A">Option A</option>
                            <option value="B">Option B</option>
                            <option value="C">Option C</option>
                            <option value="D">Option D</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="score" class="form-label">Marks</label>
                        <input type="number" class="form-control" name="score" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Question</button>
                </form>
            </div>
        </div>
    </div>
</div>
                    <script>
                        document.querySelector('form').addEventListener('submit', function(event) {
                            const answer = document.querySelector('select[name="answer"]').value;
                            const optionA = document.querySelector('input[name="option_a"]').value;
                            const optionB = document.querySelector('input[name="option_b"]').value;
                            
                            if (answer === 'A' && !optionA) {
                                event.preventDefault();
                                alert('Option A must have a value if it is selected as the correct answer.');
                            } else if (answer === 'B' && !optionB) {
                                event.preventDefault();
                                alert('Option B must have a value if it is selected as the correct answer.');
                            }
                        });
                    </script>
@endsection
