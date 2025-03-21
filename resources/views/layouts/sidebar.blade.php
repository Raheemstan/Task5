<div class="sidebar pe-4 pb-3" id="sidebar">
    <nav class="navbar navbar-light">
        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i> DASHMIN</h3>
        </a>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link active">
                <i class="fa fa-tachometer-alt me-2"></i> Dashboard
            </a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-file-alt me-2"></i> Exams
                </a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('exams.index') }}" class="dropdown-item">View Exams</a>
                    <a href="{{ route('exams.create') }}" class="dropdown-item">Create Exam</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-user me-2"></i> Students
                </a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('students.index') }}" class="dropdown-item">Manage Students</a>
                    <a href="{{ route('students.create') }}" class="dropdown-item">Register Student</a>
                </div>
            </div>

            <a href="{{ route('settings.index') }}" class="nav-item nav-link">
                <i class="fa fa-cog me-2"></i> Settings
            </a>
        </div>
    </nav>

</div>