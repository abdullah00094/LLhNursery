<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherGradeController;
use App\Models\TeacherGrade;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Grades routes
    Route::prefix('grades')->group(function () {
        Route::get('/', [GradeController::class, 'index'])->name('grades.index');
        Route::get('/create', [GradeController::class, 'create'])->name('grades.create');
        Route::post('/', [GradeController::class, 'store'])->name('grades.store');
        Route::get('/{id}/edit', [GradeController::class, 'edit'])->name('grades.edit');
        Route::get('/{id}', [GradeController::class, 'show'])->name('grades.show');
        Route::put('/{id}', [GradeController::class, 'update'])->name('grades.update');
        Route::delete('/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');
    });
    // Subjects routes
    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('subjects.index');
        Route::get('/create', [SubjectController::class, 'create'])->name('subjects.create');
        Route::post('/', [SubjectController::class, 'store'])->name('subjects.store');
        Route::get('/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
        Route::get('/{id}', [SubjectController::class, 'show'])->name('subjects.show');
        Route::put('/{id}', [SubjectController::class, 'update'])->name('subjects.update');
        Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
    });
    // Students routes
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/', [StudentController::class, 'store'])->name('students.store');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::get('/{id}', [StudentController::class, 'show'])->name('students.show');
        Route::put('/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    });
    // Absences routes
    Route::prefix('absences')->group(function () {
        Route::get('/', [AbsenceController::class, 'index'])->name('absences.index');
        Route::get('/export-absences', [AbsenceController::class, 'exportFilteredAbsences'])->name('absences.export');
        Route::get('/record', [AbsenceController::class, 'showRecordForm'])->name('absences.record');
        Route::post('/record', [AbsenceController::class, 'recordAbsences'])->name('absences.store');
        Route::delete('/{id}', [AbsenceController::class, 'destroy'])->name('absences.delete');

    });

    // Teacher grades routes (assigned grades)
    Route::prefix('assignedgrades')->group(function () {
        Route::get('/', [TeacherGradeController::class, 'index'])->name('assignedgrades.index');
        Route::get('/{id}/edit', [TeacherGradeController::class, 'edit'])->name('editAssignedGrades.edit');
        Route::put('/{id}', [TeacherGradeController::class, 'update'])->name('updateAssignedGrades.update');
        Route::delete('/{id}', [TeacherGradeController::class, 'destroy'])->name('assignedGrade.destroy');
        Route::post('/assign', [TeacherGradeController::class, 'store'])->name('assignGrade.store');
    });
    //teachers routes 
    Route::prefix('teachers')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('/', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::get('/{id}', [TeacherController::class, 'show'])->name('teachers.show');
        Route::put('/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    });
});

require __DIR__ . '/auth.php';
