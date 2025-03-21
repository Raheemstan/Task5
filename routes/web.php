<?php

use App\Http\Controllers\{
    ExamsController,
    ProfileController,
    QuestionsController,
    StudentController,
    ExamSettingController
};
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Exam Access Routes
Route::get('/exam/login', [ExamsController::class, 'showLogin'])->name('exams.login');
Route::post('/exam/authenticate', [ExamsController::class, 'authenticate'])->name('exams.authenticate');
Route::get('/exam/{exam}/start', [ExamsController::class, 'startExam'])->name('exams.start');
Route::post('/exam/{exam}/submit', [ExamsController::class, 'submitExam'])->name('exams.submit');
Route::get('/exam/{exam}/result', [ExamsController::class, 'showResult'])->name('exams.result');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resource Controllers
    Route::resource('exams', ExamsController::class);
    Route::resource('students', StudentController::class);

    // Question Management
    Route::prefix('exams/{exam}/questions')->group(function () {
        Route::get('/', [QuestionsController::class, 'index'])->name('questions.index');
        Route::get('/create', [QuestionsController::class, 'create'])->name('questions.create');
        Route::post('/store', [QuestionsController::class, 'store'])->name('questions.store');
    });
    Route::prefix('exams/questions/{question}')->group(function () {
        Route::get('/edit', [QuestionsController::class, 'edit'])->name('questions.edit');
        Route::post('/update', [QuestionsController::class, 'update'])->name('questions.update');
        Route::delete('/destroy', [QuestionsController::class, 'destroy'])->name('questions.destroy');
        Route::post('/status', [QuestionsController::class, 'status'])->name('questions.status');
    });
 
    // Exam Settings
    Route::get('/settings', [ExamSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings/update', [ExamSettingController::class, 'update'])->name('settings.update');
});

// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes
require __DIR__ . '/auth.php';
